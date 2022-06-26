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
        // ADMIN
        Trabajadores::create([
            'documento' => '10381494',
            'nombre' => 'MARCO ANTONIO TICONA RIOS',
            'cargo' => 'SOPORTE',
            'poa_status' => '0',
            'poa_evaluacion' => '0',
            'unidad_id' => '1'
        ]);

        //PLANIFICADOR
        Trabajadores::create([
            'documento' => '1081273',
            'nombre' => 'GUSTAVO IGNACIO MILOS MARQUEZ',
            'cargo' => 'JEFE DE PLANIFICACIÓN Y PROYECTOS',
            'poa_status' => '0',
            'poa_evaluacion' => '0',
            'unidad_id' => '3'  //jefatura de planificacion y proyectos
        ]);

        // TRABAJADOR
        Trabajadores::create([
            'documento' => '46428060',
            'nombre' => 'PEDRO ROJAS BARRON',
            'cargo' => 'TECNICO DE SISTEMAS',
            'poa_status' => '1',
            'poa_evaluacion' => '1',
            'unidad_id' => '5'  //AUDITORIA INTERNA
        ]);

        // GERENTE GENERAL
        Trabajadores::create([
            'documento' => '12319351',
            'nombre' => 'WILHELM PIEROLA ITURRALDE',
            'cargo' => 'GERENTE GENERAL',
            'poa_status' => '0',
            'poa_evaluacion' => '0',
            'unidad_id' => '7'
        ]);

        // Trabajadores::factory(4)->create();
    }
}
