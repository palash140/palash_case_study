<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'product_id'=>[Rule::exists('products','id')->where(function ($query) {
                      return $query->whereNull('deleted_at'); // only non soft deleted products
                })],
            'qty'=>'numeric|min:0'
        ];
    }
}
