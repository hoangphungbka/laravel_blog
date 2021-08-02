<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('brands')->insert([
            ['name' => 'Apple', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Asus', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gionee', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Micromax', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Samsung', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
