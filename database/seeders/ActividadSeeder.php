<?php

namespace Database\Seeders;

use App\Models\Actividades;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actividades_op1 = [
            'COTIZACION',
            'INICIAR PROCESOS DE ADQUISICION',
            'COMPRA DE LOS DISCOS DUROS'
        ];
        foreach($actividades_op1 as $act){
            Actividades::create([
                'nombre_actividad' => $act,
                'resultado_esperado' => rand(10,90),
                'operacion_id' => '1'
            ]);
        }

        $actividades_op2 = [
            'CONFIGURACION DE SERVIDOR COMO RAID 5'
        ];
        foreach($actividades_op2 as $act){
            Actividades::create([
                'nombre_actividad' => $act,
                'resultado_esperado' => rand(10,90),
                'operacion_id' => '2'
            ]);
        }

        $actividades_op3 = [
            'ADQUIRIR SERVICIOS'
        ];
        foreach($actividades_op3 as $act){
            Actividades::create([
                'nombre_actividad' => $act,
                'resultado_esperado' => rand(10,90),
                'operacion_id' => '3'
            ]);
        }

        // Actividades::factory(6)->create();
    }
}
