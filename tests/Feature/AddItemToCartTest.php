<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddItemToCartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_required_session_id(){

        $response=$this->json('POST', 'api/carts');
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "session_id" => [ "session_id required in heder"]
                ]
            ]);
    }



    public function test_required_fields(){

        $sessionId='reandom_session_id';
        $response=$this->withHeaders([
            'session_id'=>$sessionId
        ])->json('POST', 'api/carts');
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "product_id" => ["The product id field is required."],
                    "qty"=>[ "The qty field is required."]
                ]
            ]);
    }


    public function test_valid_product(){
        $input=[
            'product_id'=>-12
        ];
        $sessionId='reandom_session_id';
        $response=$this->withHeaders([
            'session_id'=>$sessionId
        ])->json('POST', 'api/carts',$input);
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "product_id" => ["The selected product id is invalid."]
                ]
        ]);
    }

     public function test_successful_add_item(){
        $input=[
            'product_id'=>1,
            "qty"=>1
        ];
        $sessionId='reandom_session_id';
        $response=$this->withHeaders([
            'session_id'=>$sessionId
        ])->json('POST', 'api/carts',$input);
        $response->assertStatus(200)
            ->assertJson([
                "message" => "Prodct added to cart successfully"
        ]);
    }
}
