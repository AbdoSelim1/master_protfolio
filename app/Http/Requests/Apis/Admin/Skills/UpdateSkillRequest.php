<?php

namespace App\Http\Requests\Apis\Admin\Skills;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
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
            'name' => ['required', 'string', "unique:skills,name,{$this->skill},id", 'min:2', 'max:255'],
            'status' => ['required', 'integer', 'in:0,1']
        ];
    }
}
