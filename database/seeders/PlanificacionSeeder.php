<?php

namespace Database\Seeders;

use App\Models\Planificaciones;
use Illuminate\Database\Seeder;

class PlanificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Planificaciones::create([
            'primer_trimestre' => 10,
            'segundo_trimestre' => 30,
            'tercer_trimestre' => 60,
            'cuarto_trimestre' => 0,
            'corto_plazo_accion_id' => 1
        ]);
        Planificaciones::create([
            'primer_trimestre' => 50,
            'segundo_trimestre' => 20,
            'tercer_trimestre' => 30,
            'cuarto_trimestre' => 0,
            'corto_plazo_accion_id' => 2
        ]);
    }
}
