<?php

namespace Database\Seeders;

use App\Models\Operaciones;
use Illuminate\Database\Seeder;

class OperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operaciones_acc1 = [
            'ADQUISICION DE DISCOS DUROS PARA SERVIOR',
            'CONFIGURACION DEL SERVIDOR CON EL FIN DE SACAR REPALDOS',
            'CONTRATACION DE SERVICIOS DE BACKUP EN LA NUBE'
        ];

        foreach($operaciones_acc1 as $op){
            Operaciones::create([
                'nombre_operacion' => $op,
                'corto_plazo_accion_id' => '1'
            ]);
        }

        $operaciones_acc2 = [
            'RESGUARDAR LA RED DE DATOS POR FIREWALL',
            'RESGUARDAR LA RED DE DATOS Y EQUIPOS DE COMPUTACION POR ANTIVIRUS'
        ];

        foreach($operaciones_acc2 as $op){
            Operaciones::create([
                'nombre_operacion' => $op,
                'corto_plazo_accion_id' => '2'
            ]);
        }

        // Operaciones::factory(5)->create();
    }
}
