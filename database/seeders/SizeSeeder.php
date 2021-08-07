<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $sizes = [];
        foreach (range(30, 50) as $number) {
            array_push($sizes, ['size' => $number, 'created_at' => $now, 'updated_at' => $now]);
        }

        DB::table('sizes')->insert($sizes);
    }
}
