<?php

namespace App\Http\Controllers;

use App\Models\Partidas;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF as PDF;

class PdfController extends Controller
{
    public function pdf_partida_grupo(Request $request)
    {
        $gestion = $request->gestion;
        PDF::SetTitle('Partidas Por Grupo');
        PDF::setHeaderCallback(function($pdf) use ($gestion){
            $image_file = K_PATH_IMAGES.'logo_elapas.png'; //vendor/tecnickcom/examples/images
            $pdf->Image($image_file, 5, 2, 32, '', 'PNG', '', 'T', false, 200, '', false, false, 0, false, false, false);
            // Set font
            $pdf->Ln(3); /*centrar y dar margin-top al title ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', 'B', 12);
            // Title
            $pdf->Ln(2); /*ESPACIO ENTRE LINEAS*/
            $pdf->Cell(0, 7, 'Reporte Grupo Partida', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
            $pdf->Ln(1); /*ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Ln(1);
            $pdf->Cell(0, 5, "Gestion: $gestion", 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        });

        PDF::SetMargins(10, 20, 10); //SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // ---------------------------------------------------------
        // add a page
        PDF::AddPage();

        PDF::SetFont('helvetica', '', 8);

        //
        $array = [];
        $partidas = Partidas::with(["items" => function($q) use ($gestion){
            $q->select('items.*')
            ->join('actividades', 'actividades.id', '=', 'items.actividad_id')
            ->join('operaciones', 'operaciones.id', '=', 'actividades.operacion_id')
            ->join('corto_plazo_acciones', 'corto_plazo_acciones.id', '=', 'operaciones.corto_plazo_accion_id')
            ->join('pei_objetivos_especificos', 'pei_objetivos_especificos.id', '=', 'corto_plazo_acciones.pei_objetivo_especifico_id')
            ->join('mediano_plazo_acciones', 'mediano_plazo_acciones.id', '=', 'pei_objetivos_especificos.mediano_plazo_accion_id')
            ->join('resultados', 'resultados.id', '=', 'mediano_plazo_acciones.resultado_id')
            ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            ->join('pilares', 'pilares.id', '=', 'metas.pilar_id')
            ->where('pilares.gestion_pilar', $gestion);
        }])->get();Partidas::get();
        $i = 0;
        $last_id = $partidas->last()->id; 
        foreach ($partidas as $p) {
            if( $i != substr($p->codigo_partida, 0,1) )
            {
                if (isset($grupo)) {
                    array_push($array, $grupo);
                }
                $grupo = [];
                $i++;
            }

            if( $i == substr($p->codigo_partida, 0,1) ){
                array_push($grupo, $p);
            }

            if( $p->id == $last_id ){
                array_push($array, $grupo);
            }
        }
        // return $array[0][0]->items->sum('presupuesto');
        // return $array;
        $tbl = '';
        $tbl .= <<<EOD
        <table cellspacing="0" cellpadding="5" border="1" style="border-color:gray;text-align:center;">
            <thead>
            <tr style="background-color:#686D76;color:white;font-weight:bold;">
                <th>Grupo</th>
                <th>Partida</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
        EOD;
            $total = 0;
            for ($i=0; $i <= count($array) - 1 ; $i++) { 
                foreach ($array[$i] as $p) {
                    
                    $sum_x_grupo = 0;
                    foreach ($array[$i] as $sub_partida) {
                        $sum_x_grupo += $sub_partida->items->sum('presupuesto');
                        $total += $sub_partida->items->sum('presupuesto');
                    }
                    $total_x_grupo = number_format($sum_x_grupo, 2, ".", ",");
                    $tbl .= <<<EOD
                    <tr>
                        <td> $p->codigo_partida </td>
                        <td> $p->nombre_partida </td>
                        <td> $total_x_grupo Bs.</td>
                    </tr>
                    EOD;
                    break;
                }
            }
            $total = number_format($total, 2, ".", ",");
            $tbl .= <<<EOD
            <tr>
                <td colspan="2"><b>TOTAL</b></td>
                <td><b>$total Bs.</b></td>  
            </tr>
            EOD;
        $tbl .= <<<EOD
            </tbody>
        </table>
        EOD; 

        PDF::writeHTML($tbl, true, false, false, false, '');

        // PDF::writeHTML($tbl, true, false, false, false, '');
        PDF::Output("partida_grupo_$gestion.pdf", 'I');
    }
}
