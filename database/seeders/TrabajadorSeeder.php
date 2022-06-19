<?php

namespace Database\Seeders;

use App\Models\Trabajadores;
use App\Models\Unidades;
use Illuminate\Database\Seeder;

class TrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trabajadores::create([
            'documento' => '10381494',
            'nombre' => 'MARCO ANTONIO TICONA RIOS',
            'cargo' => 'SOPORTE',
            'poa_status' => '0',
            'poa_evaluacion' => '0',
            'unidad_id' => '1'
        ]);

        Trabajadores::factory(4)->create();
    }
}
