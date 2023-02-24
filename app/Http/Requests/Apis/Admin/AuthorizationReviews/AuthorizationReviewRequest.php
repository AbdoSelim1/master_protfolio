<?php

namespace App\Http\Requests\Apis\Admin\AuthorizationReviews;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationReviewRequest extends FormRequest
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
            'key' => ['required', 'integer', 'in:0,1']
        ];
    }
}
