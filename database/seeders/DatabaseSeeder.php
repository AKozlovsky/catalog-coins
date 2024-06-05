<?php

namespace Database\Seeders;

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
        DB::table('continents')->insert($this->_getContinents());

        $this->call([
            CountrySeeder::class,
            CurrencySeeder::class,
            CollectionSeeder::class
        ]);
    }

    private function _getContinents(): array
    {
        $result = [
            ['code' => 'AF', 'continent_name' => 'Africa'],
            ['code' => 'AS', 'continent_name' => 'Asia'],
            ['code' => 'EU', 'continent_name' => 'Europe'],
            ['code' => 'NA', 'continent_name' => 'North America'],
            ['code' => 'SA', 'continent_name' => 'South America'],
            ['code' => 'OC', 'continent_name' => 'Oceania'],
            ['code' => 'AN', 'continent_name' => 'Antarctica'],
        ];

        foreach ($result as $key => $value) {
            $result[$key]["created_at"] = date('Y-m-d h:i:s');
        }

        return $result;
    }
}
