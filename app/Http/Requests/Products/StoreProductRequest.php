<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
    public function rules(){
        return [
            'name'=>'required',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric|min:0',
            'description'=>'required',
            'avatar'=>'required|url'
        ];
    }
}
