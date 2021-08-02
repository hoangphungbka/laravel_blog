<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        DB::table('colors')->insert([
            ['name' => 'Black', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Black Leather', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Black with red', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gold', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spacegrey', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
