<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('categories')->insert([
            ['name' => 'Fruits and Vegetables', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Meat and Fish', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Cooking', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Beverages', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Home and Cleaning', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pest Control', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Office Products', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
