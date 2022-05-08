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
        $items_act3 = [
            'COMPRAR DOS DISCOS DUROS DE TRESCIENTOS GB PARA SERVIDOR DELL',
            'COMPRAR DOS CABLES DATA PARA DISCOS DUROS'
        ];

        foreach($items_act3 as $itm){
            Items::create([
                'bien_servicio' => $itm,
                'fecha_requerida' => '2022-05-02',
                'presupuesto' => '500',
                'partida_id' => '1',
                'actividad_id' => '3'
            ]);
        }

        $items_act4 = [
            'COMPRAR DE MATERIALES NECESARIOS PARA LA CONFIGURACION DEL SERVIDOR'
        ];
        foreach($items_act4 as $itm){
            Items::create([
                'bien_servicio' => $itm,
                'fecha_requerida' => '2022-05-02',
                'presupuesto' => '2000',
                'partida_id' => '1',
                'actividad_id' => '4'
            ]);
        }

        // Items::factory(5)->create();
    }
}
