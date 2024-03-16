<?php

namespace App\Rules;

use Closure;
use App\Enums\TasksEnum;
use Illuminate\Contracts\Validation\ValidationRule;

class TaskEnumValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Ensure $value is an array
        if (!is_array($value)) {
            $fail('Tasks must be an array');
        }

        // Ensure $value isn't an empty array
        if(count($value) === 0){
            $fail('Tasks can\'t be empty');
        }

        // Validate each task in the array against the TaskEnum values
        foreach ($value as $task) {
            if (!in_array($task, TasksEnum::toArray())) {
                $fail('One or more tasks are invalid.');
            }
        }
    }
}
