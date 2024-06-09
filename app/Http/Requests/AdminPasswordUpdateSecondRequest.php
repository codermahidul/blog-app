<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminPasswordUpdateSecondRequest extends FormRequest
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
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function withValidator($validator):void
    {
        $validator->after(function($validator){
            if (!Hash::check($this->current_password, Auth::guard('admin')->user()->password)) {
                $validator->errors()->add('current_password', __('Current password not match.'));
            }
        });
    }
}
