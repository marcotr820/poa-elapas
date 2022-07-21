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
        // PILAR 2022
        $OP_ACC1 = [
            'SEGUIMIENTO Y EVALUACIÓN A LA IMPLEMENTACION DE MEDIDAS',
            'RELIZAR EL FORTALECIMIENTO DEDE MEDIDAS COMPLEMENTARIAS'
        ];
        foreach ($OP_ACC1 as $val) {
            Operaciones::create([
                'nombre_operacion' => $val,
                'corto_plazo_accion_id' => '1'
            ]);
        }

        $OP_ACC2 = [
            'EVALUACIÓN DE INFORMES TRIMESTRALES',
            'DEFINICIÓN DE MEDIDAS CORRECTIVAS A LAS ACCIONES'
        ];
        foreach ($OP_ACC2 as $val) {
            Operaciones::create([
                'nombre_operacion' => $val,
                'corto_plazo_accion_id' => '2'
            ]);
        }

        // PILAR 2023 ****************************************************************************************************
        Operaciones::create([
            // id = 5
            'nombre_operacion' => "CONTRATAR EQUIPOS Y MAQUINARIAS ADECUADAS PARA LA OPERACIÓN Y MANTENIMIENTO DE LOS SISTEMAS DE ADUCCIÓN",
            'corto_plazo_accion_id' => '3'
        ]);
        Operaciones::create([
            // id = 6
            'nombre_operacion' => "GARANTIZAR LA OPERACIÓN Y MANTENIMIENTO DE LOS SISTEMAS DE ADUCCIÓN.",
            'corto_plazo_accion_id' => '3'
        ]);
        Operaciones::create([
            // id = 7
            'nombre_operacion' => "ASEGURAR LA CONDUCCION DE AGUA CRUDA EN EL SISTEMA DE ADUCCIÓN CAJAMARCA.",
            'corto_plazo_accion_id' => '3'
        ]);
        
        
        // $operaciones_acc1 = [
        //     'ADQUISICION DE DISCOS DUROS PARA SERVIDOR',
        //     'CONFIGURACION DEL SERVIDOR CON EL FIN DE SACAR REPALDOS',
        //     'CONTRATACION DE SERVICIOS DE BACKUP EN LA NUBE'
        // ];
        // foreach($operaciones_acc1 as $op){
        //     Operaciones::create([
        //         'nombre_operacion' => $op,
        //         'corto_plazo_accion_id' => '1'
        //     ]);
        // }

        // $operaciones_acc2 = [
        //     'RESGUARDAR LA RED DE DATOS POR FIREWALL',
        //     'RESGUARDAR LA RED DE DATOS Y EQUIPOS DE COMPUTACION POR ANTIVIRUS'
        // ];
        // foreach($operaciones_acc2 as $op){
        //     Operaciones::create([
        //         'nombre_operacion' => $op,
        //         'corto_plazo_accion_id' => '2'
        //     ]);
        // }

        // Operaciones::factory(5)->create();
    }
}
