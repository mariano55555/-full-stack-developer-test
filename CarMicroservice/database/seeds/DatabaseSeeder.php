<?php

use App\Car;
use App\CarCategory;
use Faker\Factory;
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
        //factory(Car::class, 10)->create();

        // Crear las categorias
        $oficial     = CarCategory::create(['name' => 'Oficial', 'price_per_minute' => 0.00, 'isRegisterable' => true, 'isBillable' => false, 'monthlyCharge' => false]);
        $residente   = CarCategory::create(['name' => 'Residente', 'price_per_minute' => 0.05, 'isRegisterable' => true, 'isBillable' => true, 'monthlyCharge' => true]);
        $noresidente = CarCategory::create(['name' => 'No Residente', 'price_per_minute' => 0.5, 'isRegisterable' => false, 'isBillable' => true, 'monthlyCharge' => false]);
        $categories  = [$oficial->_id, $residente->_id, $noresidente->__id];
        //$categories  = [$oficial, $residente, $noresidente];

        // Crear 10 carros
        $faker = Factory::create();
        $brands = ["Toyota", "Nissan", "Honda", "Suzuki", "Mitsubishi", "BMW"];
        $colors = ["Black", "Blue", "Red", "Brown", "Light Blue", "Yellow"];

        for ($i=0; $i <= 10 ; $i++) {
            Car::create([
                'license_plate' => $faker->text(10),
                'color'         => $colors[rand(0, 5)],
                'brand'         => $brands[rand(0, 5)],
                'year'          => rand(date("Y") - 10, date("Y")),
                'category'      => $categories[rand(0,2)]
            ]);
        }
    }
}
