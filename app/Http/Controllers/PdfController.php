<?php

namespace App\Http\Controllers;

use App\Models\Partidas;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF as PDF;

class PdfController extends Controller
{
    public function pdf_partida_grupo()
    {   
        PDF::setHeaderCallback(function($pdf){
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
            $pdf->Cell(0, 5, "Gestion", 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        });

        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // ---------------------------------------------------------
        // add a page
        PDF::AddPage();

        PDF::SetFont('helvetica', '', 8);

        //
        $array = [];
        $partidas = Partidas::get();
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
            for ($i=0; $i <= count($array) - 1 ; $i++) { 
                foreach ($array[$i] as $p) {
                    $tbl .= <<<EOD
                    <tr>
                        <td> $p->codigo_partida </td>
                        <td> $p->nombre_partida </td>
                        <td> $p->id </td>
                    </tr>
                    EOD;
                    break;
                }
            }
        $tbl .= <<<EOD
            </tbody>
        </table>
        EOD; 

        PDF::writeHTML($tbl, true, false, false, false, '');

        // PDF::writeHTML($tbl, true, false, false, false, '');
        PDF::Output('reporte.pdf', 'I');
    }
}
