<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    public function rules()
    {
        return [
            'product_id'=>['required',Rule::exists('products','id')->where(function ($query) {
                      return $query->whereNull('deleted_at'); // only non soft deleted products
                })],
            'qty'=>'required|numeric|min:0'
        ];
    }


    public function validated(){
        parent::validated();
        $input=$this->all();
        if(auth()->user()){
            $input['user_id']=auth()->user()->id;
        }
        $input['session_id']=$this->header('session_id');
        return $input;
    }


}
