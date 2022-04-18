<?php

use App\Tariff;
use Illuminate\Database\Seeder;

class TariffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tariff::truncate();
        Tariff::create([
            'name' => 'Free',
            'requests' => '1000'
        ]);
        Tariff::create([
            'name' => 'Starter',
            'requests' => '50000'
        ]);
        Tariff::create([
            'name' => 'Enterprise',
            'requests' => '10000'
        ]);
    }
}
