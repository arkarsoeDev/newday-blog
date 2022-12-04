<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => "required|min:3|unique:posts",
            "category" => "required|exists:categories,id",
            "description" => "required|min:10",
            "featured_image" => "nullable|mimes:jpeg,png|file|max:512",
            "body" => "required",
            "tags.*" => "exists:tags,id",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tags.*.exists' => 'Selected Tags are not valid',
        ];
    }
}