<?php

namespace App\Http\Requests\Apis\Admin\Sociallinks;

use Illuminate\Foundation\Http\FormRequest;

class SocialLinkRequest extends FormRequest
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
            'url'=>['required' , 'url', 'max:255'],
            'status'=>['required', 'integer' , 'in:0,1']
        ];
    }
}
