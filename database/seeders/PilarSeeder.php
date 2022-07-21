<?php

namespace Database\Seeders;

use App\Models\Pilares;
use Illuminate\Database\Seeder;

class PilarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2022
        // id 1
        Pilares::create([
            'nombre_pilar' => 'UNIVERSALIZACIÓN DE LOS SERVICIOS BASICOS 2022',
            'gestion_pilar' => '2022'
        ]);

        // 2023
        // id 2
        Pilares::create([
            'nombre_pilar' => 'UNIVERSALIZACIÓN DE LOS SERVICIOS BASICOS',
            'gestion_pilar' => '2023'
        ]);
    }
}
