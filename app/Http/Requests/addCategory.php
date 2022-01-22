<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addCategory extends FormRequest
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
            'name' => 'required|string',
            'photo'  => 'required_without:id|nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'يرجي ادخال اسم القسم',
            'name.string' => ' يرجي ادخال اسم القسم عبارة عن نص',
            'photo.required_without' => 'يرجي ادخال صورة القسم',
        ];
    }
}
