<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller{


    public function store(StoreProductRequest $request){
        $product=Product::create($request->all());
        return response([
            'message'=>'Product created successfully',
            'Product'=>$product
        ]);
    }

    public function index(Request $request){
        $atMostPerPage=50;
        $perPage=$request->input('per_page',10);
        if($perPage > $atMostPerPage){
            $perPage=$atMostPerPage;
        }

        return Product::paginate($perPage); 
    }


    public function show(Request $request,Product $product){
        return  $product;
    }



    public function update(UpdateProductRequest $request, Product $product){
        $product->update($request->validated());
        return response([
            'message'=>'Product updated successfully',
            'product'=>$product
        ]);
 
    }


    public function destroy(Product $product){
        $product->delete();
        return response([
            'message'=>'Product Deleted successfully'
        ]);
    }

}

