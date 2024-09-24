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
            ["value" => 10000, "created_at" => date('Y-m-d h:i:s')],
            ["value" => 5000, "created_at" => date('Y-m-d h:i:s')],
        ]);
        DB::table('photos')->insert([
            ["filename" => "", "created_at" => date('Y-m-d h:i:s')]
        ]);
        DB::table('other_criteria')->insert([
            [
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
                "created_at" => date('Y-m-d h:i:s')
            ]
        ]);
        DB::table('items')->insert([
            ["currency" => "ALL", "numerical_value" => 10000, "other_criteria" => 1, "photo" => 1,  "created_at" => date('Y-m-d h:i:s')],
            ["currency" => "USD", "numerical_value" => 5000, "other_criteria" => 1, "photo" => 1, "created_at" => date('Y-m-d h:i:s')],
        ]);
        DB::table('collections')->insert([
            ["continent" => "AF", "country" => "AO", "item" => 1, "created_at" => date('Y-m-d h:i:s')],
            ["continent" => "AF", "country" => "AF", "item" => 2, "created_at" => date('Y-m-d h:i:s')],
        ]);
    }
}
