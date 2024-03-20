<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class FetchMockResultsRequest extends FormRequest
{
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
            'job-id' => 'required|string|exists:processed_jobs,job_id'
        ];
    }

    public function validationData()
    {
        return array_merge(parent::validationData(), ['job-id' => $this->route('jobId')]);
    }
}
