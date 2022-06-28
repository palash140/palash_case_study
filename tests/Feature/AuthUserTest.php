<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_required_validtion(){

        $response=$this->json('POST', 'api/auth/login');
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => ["The email field is required."],
                    "password"=>[ "The password field is required."]
                ]
            ]);

    }


    public function test_validate_credentials(){

        $input=[
            "email"=>'abc@gmail.com',
            "password"=>'123345'
        ];
        $response=$this->json('POST', 'api/auth/login',$input);
        $response->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => ["The provided credentials are incorrect."]
                ]
            ]);
    }

    public function test_valid_credentials(){

         $input=[
            "email"=>'defaultuser@gmail.com',
            "password"=>'123456'
        ];
        $response=$this->json('POST', 'api/auth/login',$input);
        $response->assertStatus(200)
            ->assertJson([
                "message" => "User logged in successfully",
            ]);
    }



}
