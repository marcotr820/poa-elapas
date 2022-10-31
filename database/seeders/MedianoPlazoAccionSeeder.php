<?php

namespace Database\Seeders;

use App\Models\MedianoPlazoAcciones;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MedianoPlazoAccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pilar 2022
        MedianoPlazoAcciones::create([
            //  id = 1
            'codigo_mediano_plazo' => 10,
            'accion_mediano_plazo' => Str::upper("Implementación del programa de renovación de medidores a traves del Banco de Medidores."),
            'resultado_id' => '1'
        ]);  
        MedianoPlazoAcciones::create([
            //  id = 2
            'codigo_mediano_plazo' => 11,
            'accion_mediano_plazo' => Str::upper("ejecucion de nuevas instalaciones."),
            'resultado_id' => '1'
        ]);
        MedianoPlazoAcciones::create([
            // id = 3
            'codigo_mediano_plazo' => 12,
            'accion_mediano_plazo' => Str::upper("Ampliación de cobertura de red de agua en los diferentes distritos"),
            'resultado_id' => '2'
        ]);
        MedianoPlazoAcciones::create([
            // id = 4
            'codigo_mediano_plazo' => 13,
            'accion_mediano_plazo' => Str::upper("Rezonificacion y Recodificación de usuarios en las distintas zonas de lectura FASE II."),
            'resultado_id' => '2'
        ]);


        // 2023
        MedianoPlazoAcciones::create([
            // id = 5
            'codigo_mediano_plazo' => 14,
            'accion_mediano_plazo' => Str::upper("Empoderamiento social y desarrollo institucional para la gestión integral y control del agua en escenarios urbanos."),
            'resultado_id' => '3'
        ]);
        MedianoPlazoAcciones::create([
            // id = 6
            'codigo_mediano_plazo' => 15,
            'accion_mediano_plazo' => Str::upper("Ejecución de Lecturas y facturación"),
            'resultado_id' => '3'
        ]);
        // MedianoPlazoAcciones::create([
        //     // id = 7
        //     'accion_mediano_plazo' => Str::upper("Ampliación de cobertura de alcantarillado (sanitario y pluvial) y saneamiento en el área urbana."),
        //     'resultado_id' => '4'
        // ]);


        $peis = [
            'Ampliación de cobertura de los servicios de agua potable en el área urbana.',
            'Empoderamiento social y desarrollo institucional para la gestión integral y control del servicio de alcantarillado y saneamiento urbanos.',
            // 'ejecucion de lecturas y facturacion.',
            // 'ejecucion de cortes y reconexiones.',
            // 'monitoreo a la atencion al cliente (odeco).',
            // 'Implementación del programa de renovación de medidores a traves del Banco de Medidores.',
            // 'actualizacion continua de catastro de usuarios.',
            // 'ejecucion de nuevas instalaciones.',
            // 'desarrollo del sistema informatico comercial.',
            // 'Rezonificacion y Recodificación de usuarios en las distintas zonas de lectura FASE II.',
            // 'Ampliación de cobertura de alcantarillado (sanitario y pluvial) y saneamiento en el área urbana.'
        ];
        // foreach($peis as $pei){
        //     MedianoPlazoAcciones::create([
        //         'accion_mediano_plazo' => Str::upper($pei),
        //         'resultado_id' => '1'
        //     ]);
        // }
        
    }
}
