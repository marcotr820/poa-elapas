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
            'accion_mediano_plazo' => Str::upper("Implementación del programa de renovación de medidores a traves del Banco de Medidores."),
            'resultado_id' => '1'
        ]);  
        MedianoPlazoAcciones::create([
            'accion_mediano_plazo' => Str::upper("ejecucion de nuevas instalaciones."),
            'resultado_id' => '1'
        ]);
        MedianoPlazoAcciones::create([
            'accion_mediano_plazo' => Str::upper("Ampliación de cobertura de alcantarillado (sanitario y pluvial) y saneamiento en el área urbana."),
            'resultado_id' => '2'
        ]);
        MedianoPlazoAcciones::create([
            'accion_mediano_plazo' => Str::upper("Rezonificacion y Recodificación de usuarios en las distintas zonas de lectura FASE II."),
            'resultado_id' => '2'
        ]);

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
