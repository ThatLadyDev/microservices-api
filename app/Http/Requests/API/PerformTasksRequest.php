<?php

namespace App\Http\Requests\API;

use App\Rules\TaskEnumValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PerformTasksRequest extends FormRequest
{
    private int $textMaximumLength = 30;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:' . $this->textMaximumLength],
            'tasks' => ['required', 'array', new TaskEnumValidationRule]
        ];
    }
}
