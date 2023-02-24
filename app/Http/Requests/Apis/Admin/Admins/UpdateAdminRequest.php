<?php

namespace App\Http\Requests\Apis\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'email',"unique:admins,email,{$this->admin},id", 'max:255'],
            'password' => ['nullable', 'string', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed' , 'max:50'],
            'password_confirmation' => ['required_with:password'],
            'email_verified_at' => ['required', 'integer', 'in:0,1']
        ];
    }
}
