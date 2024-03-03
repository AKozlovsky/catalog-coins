<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('numerical_values')->insert([
            ["value" => 10000],
            ["value" => 5000],
        ]);
        DB::table('items')->insert([
            ["currency" => "ALL", "numerical_value" => "1"],
            ["currency" => "USD", "numerical_value" => "2"]
        ]);
        DB::table('collections')->insert([
            ["continent" => "AF", "country" => "AO", "item" => 1],
            ["continent" => "AF", "country" => "AF", "item" => 2],
        ]);
    }
}
