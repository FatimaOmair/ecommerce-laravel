<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::factory(6)->create();
        \App\Models\Brand::factory(6)->create();
        \App\Models\Product::factory(24)->create();
    }
}
