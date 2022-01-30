<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addProduct extends FormRequest
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
            'price' => 'required|numeric',
            'category_id' => 'required',
            'descount' => 'numeric',
            'photo'     => 'required_without:id|nullable|image|mimes:jpg,jpeg,png|max:1999',
            'otherPhoto*'  => 'nullable|image|mimes:jpg,jpeg,png|max:1999',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'يرجي ادخال اسم المنتج',
            'details.required' => 'يرجي ادخال تفاصيل المنتج',
            'details.string' => ' يرجي ادخال تفاصيل المنتج عبارة عن نص',
            'price.required' => ' يرجي ادخال سعر المنتج',
            'price.numeric' => ' يرجي ادخال سعر المنتج عبارة عن رقم',
            'descount.numeric' => ' يرجي ادخال الخصم عبارة عن رقم',
            'category_id.required' => ' يرجي ادخال قسم المنتج',
            'photo.required_without' => 'يرجي ادخال صورة المنتج',
            'photo.image' => ' يرجي ادخال صورة المنتج عباره عن صورة',
            'otherPhoto*.image' => ' يرجي ادخال صور اخرى المنتج عباره عن صورة'
            ];
    }
}
