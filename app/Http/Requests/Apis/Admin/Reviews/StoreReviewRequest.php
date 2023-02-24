<?php

namespace App\Http\Requests\Apis\Admin\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'integer', 'in:1,2,3,4,5'],
            "description" => ['required', 'string', 'max:1000'],
            'status' => ['required', 'integer', 'in:0,1'],
            'image'=>['required' , 'file' , 'mimes:png,jpg,jpeg,webp','max:8000']
        ];
    }
}
