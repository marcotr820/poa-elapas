<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PILAR 2022
        Items::create([
            'bien_servicio' => 'MEJORAMIENTO DE LA IMAGEN INSTITUCIONAL DE LA EMPRESA',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '40000',
            'partida_id' => '1',
            'actividad_id' => '1'
        ]);
        Items::create([
            'bien_servicio' => 'CARTILLAS',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '5000',
            'partida_id' => '1',
            'actividad_id' => '1'
        ]);
        Items::create([
            'bien_servicio' => 'COMPUTADORA DE ESCRITORIO',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '9000',
            'partida_id' => '1',
            'actividad_id' => '1'
        ]);
        Items::create([
            'bien_servicio' => 'PUBLICIDAD EN RADIO Y TELEVISIÓN',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '25000',
            'partida_id' => '70',
            'actividad_id' => '2'
        ]);
        Items::create([
            'bien_servicio' => 'REFRIGERIOS',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '15000',
            'partida_id' => '100',
            'actividad_id' => '2'
        ]);
        Items::create([
            'bien_servicio' => 'LLAVEROS, REGLAS, BOLIGRAFOS Y OTROS',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '7000',
            'partida_id' => '100',
            'actividad_id' => '2'
        ]);
        Items::create([
            'bien_servicio' => 'BATERIAS ADICIONALES PARA TABLETS',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '15000',
            'partida_id' => '100',
            'actividad_id' => '3'
        ]);
        Items::create([
            'bien_servicio' => 'VEHICULOS PARA INSPECTORES DE INCONSISTENCIAS',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '55000',
            'partida_id' => '150',
            'actividad_id' => '3'
        ]);
        Items::create([
            'bien_servicio' => 'EQUIPOS DE COMPUTACIÓN',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '20000',
            'partida_id' => '180',
            'actividad_id' => '4'
        ]);
        Items::create([
            'bien_servicio' => 'COMPRA DE ACCESORIOS PARA INSTALACIONES',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '19000',
            'partida_id' => '220',
            'actividad_id' => '4'
        ]);
        Items::create([
            'bien_servicio' => 'CONSULTORIA POR PRODUCTO',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '40000',
            'partida_id' => '220',
            'actividad_id' => '4'
        ]);


        // ITEMS ACCION CORTO PLAZO
        Items::create([
            'bien_servicio' => 'ALQUILER DE GRUA PARA MANTENIMIENTO DE EQUIPOS ILUMINARIAS ETC.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '40000',
            'partida_id' => '260',
            'actividad_id' => '5'
        ]);
        Items::create([
            'bien_servicio' => 'MANTENIMIENTO PREVENTIVO DE EQUIPOS.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '50000',
            'partida_id' => '260',
            'actividad_id' => '5'
        ]);
        Items::create([
            'bien_servicio' => 'MANTENIMIENTO PREVENTIVO DE BOMBAS DE LODO.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '20000',
            'partida_id' => '300',
            'actividad_id' => '6'
        ]);
        Items::create([
            'bien_servicio' => 'REBOBINADO DE MOTORES ELECTRICOS.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '20000',
            'partida_id' => '300',
            'actividad_id' => '6'
        ]);
        Items::create([
            'bien_servicio' => 'DIESEL OIL.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '10000',
            'partida_id' => '300',
            'actividad_id' => '7'
        ]);
        Items::create([
            'bien_servicio' => 'GASOLINA PARA VEHICULOS.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '30000',
            'partida_id' => '300',
            'actividad_id' => '7'
        ]);
        Items::create([
            'bien_servicio' => 'SERVICIO TELEFONICO.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '70000',
            'partida_id' => '350',
            'actividad_id' => '8'
        ]);
        Items::create([
            'bien_servicio' => 'TONER PARA IMPRESORAS DE DIFERENTES CATACTERISTICAS.',
            'fecha_requerida' => '2022-05-02',
            'presupuesto' => '10000',
            'partida_id' => '350',
            'actividad_id' => '8'
        ]);

        // PILAR 2023
        // $items_act3 = [
        //     'COMPRAR DOS DISCOS DUROS DE TRESCIENTOS GB PARA SERVIDOR DELL',
        //     'COMPRAR DOS CABLES DATA PARA DISCOS DUROS'
        // ];

        // foreach($items_act3 as $itm){
        //     Items::create([
        //         'bien_servicio' => $itm,
        //         'fecha_requerida' => '2022-05-02',
        //         'presupuesto' => '500',
        //         'partida_id' => '1',
        //         'actividad_id' => '3'
        //     ]);
        // }

        // $items_act4 = [
        //     'COMPRAR DE MATERIALES NECESARIOS PARA LA CONFIGURACION DEL SERVIDOR'
        // ];
        // foreach($items_act4 as $itm){
        //     Items::create([
        //         'bien_servicio' => $itm,
        //         'fecha_requerida' => '2022-05-02',
        //         'presupuesto' => '2000',
        //         'partida_id' => '1',
        //         'actividad_id' => '4'
        //     ]);
        // }

        // Items::factory(5)->create();
    }
}
