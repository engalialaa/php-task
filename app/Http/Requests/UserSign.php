<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSign extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'   => 'required|string',
            'last_name'    => 'required|string',
            'phone'        => 'required|unique:users|min:11|max:11',
            'email'        => 'required|unique:users,email,'.$this->id,
            'password'     => 'required_without:id|confirmed|nullable|min:6'
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'        => 'Please enter the first name',
            'first_name.string'          => 'The first name should be a text',
            'last_name.required'         => 'Please enter the last name',
            'last_name.string'           => 'The last name should be a text',
            'password.required_without'  => 'Please enter the password',
            'password.min'               => 'Password must be greater than 6 characters',
            'password.confirmed'         => 'password not confirmed',
            'email.required'             => 'Please enter the email',
            'email.unique'               => 'Email is already registered',
            'phone.required'          => 'Please enter the phone',
            'phone.unique'            => 'phone is already registered',
            'phone.min'               => 'phone must be greater than 11 characters',
        ];
    }
}
