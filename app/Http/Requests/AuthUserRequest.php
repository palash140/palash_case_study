<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthUserRequest extends FormRequest
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
       return  [
            'email' => 'required|email',
            'password' => 'required',
        ] ;
    }



    public function withValidator($validator){
        $validator->after(function($validator){
            if($validator->errors()->isEmpty()){

                $user = User::where('email', $this->email)->first();
                if (! $user || ! Hash::check($this->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'email' => ['The provided credentials are incorrect.'],
                    ]);
                }


            }
        });
    }
}
