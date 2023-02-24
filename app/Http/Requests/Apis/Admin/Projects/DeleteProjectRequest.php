<?php

namespace App\Http\Requests\Apis\Admin\Projects;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProjectRequest extends FormRequest
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
            "media_id"=>['required' , 'integer' , 'exists:media,id'],
            "project_id"=>['required' , 'integer' , 'exists:projects,id'],
        ];
    }
}
