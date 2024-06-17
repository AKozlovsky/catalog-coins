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
            ["filename" => "", "item" => 1, "created_at" => date('Y-m-d h:i:s')]
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
                "created_at" => date('Y-m-d h:i:s')
            ]
        ]);
        DB::table('items')->insert([
            ["currency" => 1, "numerical_value" => 1, "other_criteria" => 1, "photo" => 1, "collection" => 1, "created_at" => date('Y-m-d h:i:s')],
            ["currency" => 2, "numerical_value" => 2, "other_criteria" => 1, "photo" => 1, "collection" => 2, "created_at" => date('Y-m-d h:i:s')],
        ]);
        DB::table('collections')->insert([
            ["continent" => "AF", "country" => "AO", "item" => 1, "created_at" => date('Y-m-d h:i:s')],
            ["continent" => "AF", "country" => "AF", "item" => 2, "created_at" => date('Y-m-d h:i:s')],
        ]);
    }
}
