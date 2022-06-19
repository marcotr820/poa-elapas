<?php

namespace Database\Seeders;

use App\Models\CortoPlazoAcciones;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CortoPlazoAccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cpas = [
            'RESGUARDAR LA INFORMACIÓN EMPRESARIAL',
            'RESGUARDAR LA INFRAESTUCTURA TECNOLOGICA DE ATAQUES CIBERNETICOS',
            'BRINDAR DE SERVICIO DE INTERNET',
            'MANTENIMIENTO DE LOS SISTEMAS DE ELAPAS'
        ];
        
        foreach ($cpas as $value) {
            CortoPlazoAcciones::create([
                'gestion' => '2023',
                'accion_corto_plazo' => Str::upper($value),
                'resultado_esperado' => 25,
                'presupuesto_programado' => rand(5000, 10000),
                'fecha_inicio' => date('2023-02-03'),
                'fecha_fin' => date('2023-07-03'),
                'trabajador_id' => '3',
                'pei_objetivo_especifico_id' => '1'
            ]);
        }

        CortoPlazoAcciones::factory(20)->create();
    }
}
