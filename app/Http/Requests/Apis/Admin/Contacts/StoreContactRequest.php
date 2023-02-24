<?php

namespace App\Http\Requests\Apis\Admin\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            "full_name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'email', 'max:255','unique:contacts'],
            "phone" => ['required', 'numeric', 'digits:11','unique:contacts'],
            "message" => ['required', 'string', 'max:1000']
        ];
    }
}
