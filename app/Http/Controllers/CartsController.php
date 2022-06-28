<?php

namespace App\Http\Controllers;

use App\Http\Requests\Carts\StoreProductRequest;
use App\Http\Requests\Carts\UpdateProductRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartsController extends Controller{


    public function store(StoreProductRequest $request){
        Cart::create($request->validated());

        return response([
            'message'=>'Prodct added to cart successfully'
        ]);

    }


    public function index(Request $request){
        $items=Cart::with('product')->where('session_id',$request->header('session_id'))->get();
        return response([
            'products'=>$items
        ]);
    }


    public function update(UpdateProductRequest $request,Cart $cart){
        $cart->update($request->validated()); 

        return response([
            'message'=>'Product updated in cart'
        ]);
    }

    public function destroy(Cart $cart){
        $cart->delete();
        return response([
            'message'=>'Product removed from cart'
        ]);
    }
}
