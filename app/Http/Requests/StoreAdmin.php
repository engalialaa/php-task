<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|unique:admins,email,'.$this->id,
            'password'  => 'required_without:id|nullable|min:6',
        ];
    }
    public function messages()
    {
        return [
            'name.required'              => 'يرجي ادخال اسم المشرف',
            'password.required_without'  => 'يرجي ادخال كلمة المرور',
            'password.min'               => 'يجب ان تكون كلمة المرور اكبر من 6 حروف',
            'email.required'             => 'يرجي ادخال البريد الالكتروني',
            'email.unique'               => 'البريد مسجل من قبل',
        ];
    }
}
