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
        Resultados::create([
            'nombre_resultado' => Str::upper('El 95% de la población urbana cuenta con servicios de agua potable.'),
            'meta_id' => '1'
        ]);

        Resultados::create([
            'nombre_resultado' => Str::upper('El 70% de la población urbana cuenta con servicios de alcantarillado y saneamiento.'),
            'meta_id' => '1'
        ]);
        
    }
}
