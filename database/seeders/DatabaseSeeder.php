<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class, ColorSeeder::class, BrandSeeder::class, SizeSeeder::class
        ]);

        Customer::factory(10)->create();
        Product::factory(100)->create();
    }
}
