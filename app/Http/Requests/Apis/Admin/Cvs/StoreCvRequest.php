<?php

namespace App\Http\Requests\Apis\Admin\Cvs;

use Illuminate\Foundation\Http\FormRequest;

class StoreCvRequest extends FormRequest
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
            "status" => ['required', 'integer', 'in:0,1'],
            "name" => ['required', 'string', 'max:255'],
            "company_name" => ['nullable', 'string', 'max:255'],
            "cv" => ['required', 'file', 'max:8000']
        ];
    }
}
