<?php

namespace Database\Seeders;

use App\Models\PeiObjetivosEspecificos;
use Illuminate\Database\Seeder;

class PeiObjetivoInstitucionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'LIDERAR EL PROCESO DE FORTALECIMIENTO EMPRESARIAL PARA MEJORAR EL DESEMPEÑO EN TODAS LAS AREAS Y UNIDADES.',
            'ponderacion' => 20,
            'indicador_proceso' => 'MEJORAR LOS PROCESOS PARA LA TOMA DE DECISIONES',
            'gerencia_id' => '1',
            'mediano_plazo_accion_id' => '2' 
        ]);

        // DATOS PRUEBA GESTION ANTERIOR 2022
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'PEI OBJETIVO ESPECIFICO PRUEBA 2022',
            'ponderacion' => 20,
            'indicador_proceso' => 'DETALE PRUEBA',
            'gerencia_id' => '1',
            'mediano_plazo_accion_id' => '4' 
        ]);
    }
}
