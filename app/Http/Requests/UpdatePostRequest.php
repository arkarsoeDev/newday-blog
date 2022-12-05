<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            "title" =>  "required|min:10|unique:posts,title," . $this->route('post')->id,
            "category" => "required|exists:categories,id",
            "description" => "required|min:20",
            "featured_image" => "nullable|mimes:png,jpeg|file|max:512",
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