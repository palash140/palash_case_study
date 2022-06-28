<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DefaultCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        if(Category::exists()){

           return  true; 
        }

        Category::create([
            'name'=>'Default Category'
        ]);
    }
}
