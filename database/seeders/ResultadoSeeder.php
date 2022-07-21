<?php

namespace Database\Seeders;

use App\Models\Resultados;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pilar 2022
        Resultados::create([
            // id = 1
            'nombre_resultado' => Str::upper('El 90% de la población urbana cuenta con servicios de agua potable.'),
            'meta_id' => '1'
        ]);

        Resultados::create([
            // id = 2
            'nombre_resultado' => Str::upper('El 67% de la población urbana cuenta con servicios de alcantarillado y saneamiento.'),
            'meta_id' => '1'
        ]);

        // pilar 2023
        Resultados::create([
            // id = 3
            'nombre_resultado' => Str::upper('El 95% de la población urbana cuenta con servicios de agua potable.'),
            'meta_id' => '2'
        ]);
        // Resultados::create([
        //     // id = 4
        //     'nombre_resultado' => Str::upper('El 70% de la población urbana cuenta con servicios de alcantarillado y saneamiento.'),
        //     'meta_id' => '2'
        // ]);
        
    }
}
