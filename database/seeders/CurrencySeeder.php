<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert($this->_getData());
    }

    private function _getData(): array
    {
        $result = [
            ['code' => 'ALL', 'name' => 'Leke', 'symbol' => 'Lek'],
            ['code' => 'USD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'AFN', 'name' => 'Afghanis', 'symbol' => '؋'],
            ['code' => 'ARS', 'name' => 'Pesos', 'symbol' => '$'],
            ['code' => 'AWG', 'name' => 'Guilders', 'symbol' => 'ƒ'],
            ['code' => 'AUD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'AZN', 'name' => 'New Manats', 'symbol' => 'ман'],
            ['code' => 'BSD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'BBD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'BYR', 'name' => 'Rubles', 'symbol' => 'p.'],
            ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'],
            ['code' => 'BZD', 'name' => 'Dollars', 'symbol' => 'BZ$'],
            ['code' => 'BMD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'BOB', 'name' => 'Bolivianos', 'symbol' => '$b'],
            ['code' => 'BAM', 'name' => 'Convertible Marka', 'symbol' => 'KM'],
            ['code' => 'BWP', 'name' => 'Pula', 'symbol' => 'P'],
            ['code' => 'BGN', 'name' => 'Leva', 'symbol' => 'лв'],
            ['code' => 'BRL', 'name' => 'Reais', 'symbol' => 'R$'],
            ['code' => 'GBP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'BND', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'KHR', 'name' => 'Riels', 'symbol' => '៛'],
            ['code' => 'CAD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'KYD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'CLP', 'name' => 'Pesos', 'symbol' => '$'],
            ['code' => 'CNY', 'name' => 'Yuan Renminbi', 'symbol' => '¥'],
            ['code' => 'COP', 'name' => 'Pesos', 'symbol' => '$'],
            ['code' => 'CRC', 'name' => 'Colón', 'symbol' => '₡'],
            ['code' => 'HRK', 'name' => 'Kuna', 'symbol' => 'kn'],
            ['code' => 'CUP', 'name' => 'Pesos', 'symbol' => '₱'],
            ['code' => 'CZK', 'name' => 'Koruny', 'symbol' => 'Kč'],
            ['code' => 'DKK', 'name' => 'Kroner', 'symbol' => 'kr'],
            ['code' => 'DOP ', 'name' => 'Pesos', 'symbol' => 'RD$'],
            ['code' => 'XCD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'EGP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'SVC', 'name' => 'Colones', 'symbol' => '$'],
            ['code' => 'FKP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'FJD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'GHC', 'name' => 'Cedis', 'symbol' => '¢'],
            ['code' => 'GIP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'GTQ', 'name' => 'Quetzales', 'symbol' => 'Q'],
            ['code' => 'GGP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'GYD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'HNL', 'name' => 'Lempiras', 'symbol' => 'L'],
            ['code' => 'HKD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'HUF', 'name' => 'Forint', 'symbol' => 'Ft'],
            ['code' => 'ISK', 'name' => 'Kronur', 'symbol' => 'kr'],
            ['code' => 'INR', 'name' => 'Rupees', 'symbol' => '₹'],
            ['code' => 'IDR', 'name' => 'Rupiahs', 'symbol' => 'Rp'],
            ['code' => 'IRR', 'name' => 'Rials', 'symbol' => '﷼'],
            ['code' => 'IMP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'ILS', 'name' => 'New Shekels', 'symbol' => '₪'],
            ['code' => 'JMD', 'name' => 'Dollars', 'symbol' => 'J$'],
            ['code' => 'JPY', 'name' => 'Yen', 'symbol' => '¥'],
            ['code' => 'JEP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'KZT', 'name' => 'Tenge', 'symbol' => 'лв'],
            ['code' => 'KPW', 'name' => 'Won', 'symbol' => '₩'],
            ['code' => 'KRW', 'name' => 'Won', 'symbol' => '₩'],
            ['code' => 'KGS', 'name' => 'Soms', 'symbol' => 'лв'],
            ['code' => 'LAK', 'name' => 'Kips', 'symbol' => '₭'],
            ['code' => 'LVL', 'name' => 'Lati', 'symbol' => 'Ls'],
            ['code' => 'LBP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'LRD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'CHF', 'name' => 'Switzerland Francs', 'symbol' => 'CHF'],
            ['code' => 'LTL', 'name' => 'Litai', 'symbol' => 'Lt'],
            ['code' => 'MKD', 'name' => 'Denars', 'symbol' => 'ден'],
            ['code' => 'MYR', 'name' => 'Ringgits', 'symbol' => 'RM'],
            ['code' => 'MUR', 'name' => 'Rupees', 'symbol' => '₨'],
            ['code' => 'MXN', 'name' => 'Pesos', 'symbol' => '$'],
            ['code' => 'MNT', 'name' => 'Tugriks', 'symbol' => '₮'],
            ['code' => 'MZN', 'name' => 'Meticais', 'symbol' => 'MT'],
            ['code' => 'NAD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'NPR', 'name' => 'Rupees', 'symbol' => '₨'],
            ['code' => 'ANG', 'name' => 'Guilders', 'symbol' => 'ƒ'],
            ['code' => 'NZD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'NIO', 'name' => 'Cordobas', 'symbol' => 'C$'],
            ['code' => 'NGN', 'name' => 'Nairas', 'symbol' => '₦'],
            ['code' => 'NOK', 'name' => 'Krone', 'symbol' => 'kr'],
            ['code' => 'OMR', 'name' => 'Rials', 'symbol' => '﷼'],
            ['code' => 'PKR', 'name' => 'Rupees', 'symbol' => '₨'],
            ['code' => 'PAB', 'name' => 'Balboa', 'symbol' => 'B/.'],
            ['code' => 'PYG', 'name' => 'Guarani', 'symbol' => 'Gs'],
            ['code' => 'PEN', 'name' => 'Nuevos Soles', 'symbol' => 'S/.'],
            ['code' => 'PHP', 'name' => 'Pesos', 'symbol' => 'Php'],
            ['code' => 'PLN', 'name' => 'Zlotych', 'symbol' => 'zł'],
            ['code' => 'QAR', 'name' => 'Rials', 'symbol' => '﷼'],
            ['code' => 'RON', 'name' => 'New Lei', 'symbol' => 'lei'],
            ['code' => 'RUB', 'name' => 'Rubles', 'symbol' => 'руб'],
            ['code' => 'SHP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'SAR', 'name' => 'Riyals', 'symbol' => '﷼'],
            ['code' => 'RSD', 'name' => 'Dinars', 'symbol' => 'Дин.'],
            ['code' => 'SCR', 'name' => 'Rupees', 'symbol' => '₨'],
            ['code' => 'SGD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'SBD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'SOS', 'name' => 'Shillings', 'symbol' => 'S'],
            ['code' => 'ZAR', 'name' => 'Rand', 'symbol' => 'R'],
            ['code' => 'LKR', 'name' => 'Rupees', 'symbol' => '₨'],
            ['code' => 'SEK', 'name' => 'Kronor', 'symbol' => 'kr'],
            ['code' => 'SRD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'SYP', 'name' => 'Pounds', 'symbol' => '£'],
            ['code' => 'TWD', 'name' => 'New Dollars', 'symbol' => 'NT$'],
            ['code' => 'THB', 'name' => 'Baht', 'symbol' => '฿'],
            ['code' => 'TTD', 'name' => 'Dollars', 'symbol' => 'TT$'],
            ['code' => 'TRY', 'name' => 'Lira', 'symbol' => '₺'],
            ['code' => 'TRL', 'name' => 'Liras', 'symbol' => '£'],
            ['code' => 'TVD', 'name' => 'Dollars', 'symbol' => '$'],
            ['code' => 'UAH', 'name' => 'Hryvnia', 'symbol' => '₴'],
            ['code' => 'UYU', 'name' => 'Pesos', 'symbol' => '$U'],
            ['code' => 'UZS', 'name' => 'Sums', 'symbol' => 'лв'],
            ['code' => 'VEF', 'name' => 'Bolivares Fuertes', 'symbol' => 'Bs'],
            ['code' => 'VND', 'name' => 'Dong', 'symbol' => '₫'],
            ['code' => 'YER', 'name' => 'Rials', 'symbol' => '﷼'],
            ['code' => 'ZWD', 'name' => 'Zimbabwe Dollars', 'symbol' => 'Z$']
        ];

        foreach ($result as $key => $value) {
            $result[$key]["created_at"] = date('Y-m-d h:i:s');
        }

        return $result;
    }
}
