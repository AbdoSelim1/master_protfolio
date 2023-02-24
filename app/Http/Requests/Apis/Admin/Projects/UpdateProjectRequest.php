<?php

namespace App\Http\Requests\Apis\Admin\Projects;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            "name" => ['required', 'string', 'max:255'],
            "github_url" => ['required', 'url', 'max:255'],
            "preview_url" => ['required', 'url', 'max:255'],
            "tools" => ['required', 'array'],
            "description" => ['nullable', 'string', 'max:1000'],
            "start_date" => ['nullable', 'date_format:Y-m-d'],
            "status" => ['required', 'integer', 'in:0,1'],
            'priority'=>['required','integer','between:1,999'],
            'images' => ['nullable', 'array'],
            'images.*.filename' => ['nullable', 'file', 'max:8000', 'mimes:png,jpg,jpeg,webp']
        ];
    }
}
