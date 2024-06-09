<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLanguageStoreRequest extends FormRequest
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
            'language' => 'required|max:255|unique:languages,language',
            'slug' => 'required|max:255|unique:languages,slug',
            'default' => 'required',
            'status' => 'required',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function($validator){
            if ($validator->errors()->has('slug')) {
                $validator->errors()->add('language', __('The language  has already been taken.'));
            }
        });
    }

}
