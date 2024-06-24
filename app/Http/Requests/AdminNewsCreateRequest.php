<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminNewsCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'language' => 'required',
            'category' => 'required',
            'thumbnail' => 'required|image:jpg,jpeg,png|max:3000',
            'title' => 'required|unique:news,title|max:255',
            'content' => 'required',
            'tags' => 'required',
            'meta_title' => 'max:255',
            'meta_description' => 'max:255',
        ];
    }
}
