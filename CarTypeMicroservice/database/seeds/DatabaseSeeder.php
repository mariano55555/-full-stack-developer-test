<?php

use App\CarCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        CarCategory::create(['name' => 'Oficial', 'price_per_minute' => 0.00, 'isRegisterable' => true, 'isBillable' => false, 'monthlyCharge' => false]);
        CarCategory::create(['name' => 'Residente', 'price_per_minute' => 0.05, 'isRegisterable' => true, 'isBillable' => true, 'monthlyCharge' => true]);
        CarCategory::create(['name' => 'No Residente', 'price_per_minute' => 0.5, 'isRegisterable' => false, 'isBillable' => true, 'monthlyCharge' => false]);

    }
}
