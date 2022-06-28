<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DefaultProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        if(Product::exists()){
            return true;
        }

        $defaultCategoryId=1;

        Product::create([
            'name'=>'Default Produdct',
            'category_id'=>$defaultCategoryId,
            'price'=>23,
            'avatar'=>'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50',
            'description'=>'This is default product'
        ]);

        
    }
}
