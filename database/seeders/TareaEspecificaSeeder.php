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
        // PILAR 2022
        $TAR_ACT1 = [
            'REALIZAR COTIZACIONES',
            'CONTRATACIÓN DE MEDIOS DE COMUNICACIÓN',
            'PUBLICIDAD EN PRENSA ESCRITA'
        ];
        foreach($TAR_ACT1 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '1'
            ]);
        }

        $TAR_ACT2 = [
            'REALIZAR TRIPTICOS',
            'ELABORACIÓN DE AFICHES',
            'MEJORAMIENTO DEL COMPONENTE SOCIAL DE LA EMPRESA CON LOS USUARIOS'
        ];
        foreach($TAR_ACT2 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '2'
            ]);
        }

        $TAR_ACT3 = [
            'PROGRAMAR CORTES',
            'RECEPCIONAR TRAMITES',
            'ELABORACIÓN DE PROCEDIMIENTOS'
        ];
        foreach($TAR_ACT3 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '3'
            ]);
        }

        $TAR_ACT4 = [
            'COMPRAR ACCESORIOS NECESARIOS',
            'RECEPCIÓ Y EVALUACIÓN DE DOCUMENTOS'
        ];
        foreach($TAR_ACT4 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '4'
            ]);
        }
        
        $TAR_ACT5 = [
            'ALQUILAR EQUIPOS',
            'MANTENIMIENTO Y REPARACIÓN DE VEHIVULOS, MAQUINARIA Y EQUIPOS'
        ];
        foreach($TAR_ACT5 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '5'
            ]);
        }

        $TAR_ACT6 = [
            'COMPRA DE COMBUSTIBLES LUBRICANTES Y DERIVADOS PARA CONSUMO',
            'COMPRA DE UTILES Y MATERIALES ELÉCTRONICOS'
        ];
        foreach($TAR_ACT6 as $tar){
            TareasEspecificas::create([
                'nombre_tarea' => $tar,
                'actividad_id' => '6'
            ]);
        }


        // PILAR 2023
        // $tareas_act1 = [
        //     'COTIZAR'
        // ];
        // foreach($tareas_act1 as $tar){
        //     TareasEspecificas::create([
        //         'nombre_tarea' => $tar,
        //         'actividad_id' => '1'
        //     ]);
        // }

        // $tareas_act2 = [
        //     'LLENAR FORMULARIOS DE ADQUISICION DE MATERIAL',
        //     'HACER FIRMAR LOS FORMULARIOS',
        //     'REALIZAR CERTIFICACION PRESUPUESTARIA',
        //     'ENTREGAR CERTIFICACIONES A ADQUISICIONES'
        // ];
        // foreach($tareas_act2 as $tar){
        //     TareasEspecificas::create([
        //         'nombre_tarea' => $tar,
        //         'actividad_id' => '2'
        //     ]);
        // }

        // $tareas_act3 = [
        //     'REALIZAR INFORME DE RECEPCION'
        // ];
        // foreach($tareas_act3 as $tar){
        //     TareasEspecificas::create([
        //         'nombre_tarea' => $tar,
        //         'actividad_id' => '3'
        //     ]);
        // }

        // $tareas_act4 = [
        //     'CONFIGURAR SERVIDOR'
        // ];
        // foreach($tareas_act4 as $tar){
        //     TareasEspecificas::create([
        //         'nombre_tarea' => $tar,
        //         'actividad_id' => '4'
        //     ]);
        // }

        // $tareas_act5 = [
        //     'COTIZAR SERVIDOR',
        //     'INICIAR PROCESO DE ADQUISICION',
        //     'CONTRATAR SERVICIO'
        // ];
        // foreach($tareas_act5 as $tar){
        //     TareasEspecificas::create([
        //         'nombre_tarea' => $tar,
        //         'actividad_id' => '5'
        //     ]);
        // }

        // TareasEspecificas::factory(7)->create();
    }
}
