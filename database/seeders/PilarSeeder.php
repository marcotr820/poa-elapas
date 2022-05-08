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
        Pilares::create([
            'nombre_pilar' => 'UNIVERSALIZACION DE LOS SERVICIOS BASICOS',
            'gestion_pilar' => '2023'
        ]);
    }
}
