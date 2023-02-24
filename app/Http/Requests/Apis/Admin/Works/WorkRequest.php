<?php

namespace App\Http\Requests\Apis\Admin\Works;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'status' => ['required', 'integer', 'in:0,1'],
            'company_name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date', 'date_format:Y-m-d'],
            'job_title' => ['required', 'string', 'max:255'],
            'job_type' => ['required', 'string', 'max:255'],
            'job_responsibilities' => ['required', 'string', 'max:255']
        ];
    }
}
