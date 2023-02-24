<?php

namespace App\Http\Requests\Apis\Admin\Educations;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            "faculty" => ['required' ,  'string' , 'max:255'],
            "university" => ['nullable' ,  'string' , 'max:255'],
            "specialization" => ['nullable' ,  'string' , 'max:255'],
            "status" => ['required' , 'integer' , 'in:0,1'],
            "start_date" => ['required' , 'date' ,'date_format:Y-m-d'],
            "end_date" => ['nullable' , 'date' ,'date_format:Y-m-d'],
            "description" => ['nullable' , 'string' , 'max:1000'],
            "degree" => ['nullable' , 'string' , 'max:255'],
            "gpa" => ['nullable' , 'numeric',"min:50" , 'max:100']
        ];
    }
}
