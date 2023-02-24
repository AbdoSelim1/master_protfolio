<?php

namespace App\Http\Requests\Apis\Admin\PersonalInformation;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInformationRequest extends FormRequest
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
            "city" => ['required' , 'string' , 'max:50'],
            "country" => ['required', 'string' , 'max:50'],
            "email" => ['required','email' , 'max:255'],
            "phone" => ['required', 'numeric', 'digits:11'],
            "job_title" => ['required' , 'string' , 'max:100'],
            "status" => ['required' ,'integer' , 'in:0,1'],
            "age" => ['required', 'integer' , 'min:20' , 'max:40'],
            "about" => ['nullable', 'string' ,'max:255']
        ];
    }
}
