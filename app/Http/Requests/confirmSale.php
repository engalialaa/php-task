<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class confirmSale extends FormRequest
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
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'required',
            'phone'       => 'required|min:11|max:11',
            'street'      => 'required',
        ];
    }

    public function messages()
    {
        return [

            'first_name.required'        => 'Please enter the first name',
            'first_name.string'          => 'The first name should be a text',
            'last_name.required'         => 'Please enter the last name',
            'last_name.string'           => 'The last name should be a text',
            'email.required'             => 'Please enter the email',
            'phone.required'             => 'Please enter the phone',
            'phone.min'                  => 'phone must be greater than 11 characters',
            'street.required'            => 'Please enter the Detailed address',
        ];
    }
}
