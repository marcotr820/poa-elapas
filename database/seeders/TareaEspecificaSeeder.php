<?php

namespace Database\Seeders;

use App\Models\TareasEspecificas;
use Illuminate\Database\Seeder;

class TareaEspecificaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tareas_act1 = [
            'COTIZAR'
        ];
        foreach($tareas_act1 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '1'
            ]);
        }

        $tareas_act2 = [
            'LLENAR FORMULARIOS DE ADQUISICION DE MATERIAL',
            'HACER FIRMAR LOS FORMULARIOS',
            'REALIZAR CERTIFICACION PRESUPUESTARIA',
            'ENTREGAR CERTIFICACIONES A ADQUISICIONES'
        ];
        foreach($tareas_act2 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '2'
            ]);
        }

        $tareas_act3 = [
            'REALIZAR INFORME DE RECEPCION'
        ];
        foreach($tareas_act3 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '3'
            ]);
        }

        $tareas_act4 = [
            'CONFIGURAR SERVIDOR'
        ];
        foreach($tareas_act4 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '4'
            ]);
        }

        $tareas_act5 = [
            'COTIZAR SERVIDOR',
            'INICIAR PROCESO DE ADQUISICION',
            'CONTRATAR SERVICIO'
        ];
        foreach($tareas_act5 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '5'
            ]);
        }

        // TareasEspecificas::factory(7)->create();
    }
}
