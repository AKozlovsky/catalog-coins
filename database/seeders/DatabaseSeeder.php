<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        date_default_timezone_set("Europe/Prague");

        DB::table('continents')->insert([
            ['code' => 'AF', 'continent_name' => 'Africa', 'created_at' => date('Y-m-d h:i:s')],
            ['code' => 'AS', 'continent_name' => 'Asia', 'created_at' => date('Y-m-d h:i:s')],
            ['code' => 'EU', 'continent_name' => 'Europe', 'created_at' => date('Y-m-d h:i:s')],
            ['code' => 'NA', 'continent_name' => 'North America', 'created_at' => date('Y-m-d h:i:s')],
            ['code' => 'SA', 'continent_name' => 'South America', 'created_at' => date('Y-m-d h:i:s')],
            ['code' => 'OC', 'continent_name' => 'Oceania', 'created_at' => date('Y-m-d h:i:s')],
        ]);

        $this->call([
            CountrySeeder::class,
            CurrencySeeder::class,
            CollectionSeeder::class
        ]);
    }
}
