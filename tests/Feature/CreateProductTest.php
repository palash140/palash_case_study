<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_required_fields()
    {

        Sanctum::actingAs(User::first());
        $response=$this->json('POST', 'api/products');
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "category_id"=>[ "The category id field is required."],
                    "price"=>[ "The price field is required."],
                    "description"=>[ "The description field is required."],
                    "avatar"=>[ "The avatar field is required."]
                ]
            ]);
    }


    public function test_valid_category($value=''){

        $input=[
            'category_id'=>-12
        ];
        Sanctum::actingAs(User::first());
        $response=$this->json('POST', 'api/products',$input);
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "category_id"=>["The selected category id is invalid."]
                ]
            ]);
    }


    public function test_valid_price($value=''){
         $input=[
            'price'=>"abc"
        ];
        Sanctum::actingAs(User::first());
        $response=$this->json('POST', 'api/products',$input);
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "price"=>["The price must be a number."]
                ]
            ]);
    }
}
