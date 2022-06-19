<?php

namespace Database\Seeders;

use App\Models\Unidades;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $unidades_gerencia_general = [
        //     'sistemas informaticos',
        //     'asesoria juridica',
        //     'jefatura de planificacion y proyectos',
        //     'relaciones publicas y gestion social',
        //     'auditoria interna',
        //     'odeco',
        //     'gerencia general'
        // ];
        // foreach($unidades_gerencia_general as $unidad){
        //     Unidades::create([
        //         'nombre_unidad' => Str::upper($unidad),
        //         'gerencia_id' => '1'
        //     ]);
        // }

        $unidades_gerencia_administrativa = [
            'jefatura financiera y contable',
            'jefatura administrativa y personal',
            'gerencia administrativa'
        ];
        foreach($unidades_gerencia_administrativa as $unidad){
            Unidades::create([
                'nombre_unidad' => Str::upper($unidad),
                'gerencia_id' => '1'
            ]);
        }

        $unidades_gerencia_comercial = [
            'jefatura atc y control mora',
            'jefatura medicion y facturacion',
            'gerencia comercial'
        ];
        foreach($unidades_gerencia_comercial as $unidad){
            Unidades::create([
                'nombre_unidad' => Str::upper($unidad),
                'gerencia_id' => '2'
            ]);
        }
        
        $unidades_gerencia_tecnica = [
            'jefatura de aduccion',
            'jefatura planta potabilizadora',
            'jefatura red de agua',
            'jefatura red de alcantarillado',
            'jefatura ptar',
            'jefatura control de calidad',
            'gerencia tecnica'
        ];
        foreach($unidades_gerencia_tecnica as $unidad){
            Unidades::create([
                'nombre_unidad' => Str::upper($unidad),
                'gerencia_id' => '3'
            ]);
        }
    }
}
