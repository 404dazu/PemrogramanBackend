<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'id' => 1,
            'name' => "Positive",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statuses')->insert([
            'id' => 2,
            'name' => "Recovered",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('statuses')->insert([
            'id' => 3,
            'name' => "Dead",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
