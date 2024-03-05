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
            ["currency" => "1", "numerical_value" => "1", "other_criteria" => 1],
            ["currency" => "2", "numerical_value" => "2", "other_criteria" => 1],
        ]);
        DB::table('other_criteria')->insert([
            [
                "item" => 1,
                "monarch" => "František II",
                "reign_period_from" => 1792,
                "reign_period_to" => 1806,
                "mintage_year" => 1792,
                "avers" => "František II",
                "revers" => "Erb",
                "coin_edge" => "",
                "century" => 18,
                "metal" => "Ag",
                "quality" => "Proof",
                "price_by_krause" => 25,
            ]
        ]);
        DB::table('collections')->insert([
            ["continent" => "AF", "country" => "AO", "item" => 1],
            ["continent" => "AF", "country" => "AF", "item" => 2],
        ]);
    }
}
