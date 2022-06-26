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
        // PILAR 2022
        // GERENCIA GENERAL
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'GESTIONAR LA EJECUCIÓN DEL PROYECTO SUCRE III Y SUCRE IV.',
            'ponderacion' => 50,
            'indicador_proceso' => 'MEJORAR LOS PROCESOS PARA LA TOMA DE DECISIONES.',
            'gerencia_id' => '1',
            'mediano_plazo_accion_id' => '3' 
        ]);
        // GERENCIA ADMINISTRATIVA
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'MEJORAR LOS PROCESOS DE ATENCIÓN AL CLIENTE EN LA EMPRESA.',
            'ponderacion' => 40,
            'indicador_proceso' => 'MEJORAR LAS ACTIVIDADES.',
            'gerencia_id' => '2',
            'mediano_plazo_accion_id' => '2' 
        ]);
        
        // GERENCIA COMERCIAL
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'OPTIMIZAR LOS PROCESOS DE MEDICIÓN, FACTURACIÓN, COBRANZA Y ATENCIÓN DE USUARIOS.',
            'ponderacion' => 40,
            'indicador_proceso' => 'MEJORAR LAS ACTIVIDADES.',
            'gerencia_id' => '3',
            'mediano_plazo_accion_id' => '4' 
        ]);

        // GERENCIA TECNICA
        PeiObjetivosEspecificos::create([
            'objetivo_institucional' => 'INCREMENTAR LA EFICIENCIA OPERATIVA DEL SISTEMA DE AGUA Y ALCANTARILLADO PARA MEJORAR LA COBERTURA DEL SERVICIO',
            'ponderacion' => 50,
            'indicador_proceso' => 'MEJORAR LOS PROCESOS.',
            'gerencia_id' => '4',
            'mediano_plazo_accion_id' => '1' 
        ]);

        // PILAR 2023
        // PeiObjetivosEspecificos::create([
        //     'objetivo_institucional' => 'LIDERAR EL PROCESO DE FORTALECIMIENTO EMPRESARIAL PARA MEJORAR EL DESEMPEÑO EN TODAS LAS AREAS Y UNIDADES.',
        //     'ponderacion' => 20,
        //     'indicador_proceso' => 'MEJORAR LOS PROCESOS PARA LA TOMA DE DECISIONES',
        //     'gerencia_id' => '1',
        //     'mediano_plazo_accion_id' => '2' 
        // ]);
    }
}
