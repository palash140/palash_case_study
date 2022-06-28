<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RegisterDefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){


        if(User::exists()){
            return true; 
        }


         User::create([
            'name'=>'Default User',
            'email'=>'defaultuser@gmail.com',
            'password'=>\Hash::make('123456')
        ]);

    }
}
