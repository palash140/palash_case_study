<?php

namespace Database\Seeders;

use Database\Seeders\DefaultCategorySeeder;
use Database\Seeders\DefaultProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // \App\Models\User::factory(10)->create();

        $this->call([
            RegisterDefaultUserSeeder::class,
            DefaultCategorySeeder::class,
            DefaultProductSeeder::class
        ]);
    }
}
