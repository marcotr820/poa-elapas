<?php

namespace App\Http\Controllers;

use App\Models\Gerencias;
use App\Models\Pilares;
use Elibyy\TCPDF\Facades\TCPDF as PDF;
use Illuminate\Http\Request;

class ConsolidarPOAController extends Controller
{
    public function index()
    {
        $gerencias = Gerencias::get();
        $pilar_gestion = Pilares::select('gestion_pilar')->groupBy('gestion_pilar')->orderBy('gestion_pilar', 'asc')->get();
        return view('consolidar.index', compact('gerencias', 'pilar_gestion'));
    }

    public function pdf_consolidar(Request $request)
    {
        $pilares = Pilares::where('gestion_pilar', $request->gestion)->with('metas.resultados.acciones_mediano_plazo.pei_objetivos_especificos')->get();
        // return view('consolidar.pdf_consolidar', compact('pilares'));

        $view = view('consolidar.pdf_consolidar', compact('pilares'));
        $html = $view->render();
        PDF::SetTitle('consoldiar example');
        PDF::setHeaderCallback(function($pdf) {
            $image_file = K_PATH_IMAGES.'logo_elapas.png'; //vendor/tecnickcom/examples/images
            $pdf->Image($image_file, 5, 2, 32, '', 'PNG', '', 'T', false, 200, '', false, false, 0, false, false, false);
            // Set font
            $pdf->Ln(3); /*centrar y dar margin-top al title ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', 'B', 12);
            // Title
            $pdf->Ln(2); /*ESPACIO ENTRE LINEAS*/
            $pdf->Cell(0, 7, 'example', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
            $pdf->Ln(1); /*ESPACIO ENTRE LINEAS*/
            $pdf->SetFont('helvetica', '', 10);
            $pdf->Ln(1);
            $pdf->Cell(0, 5, "Gestion:", 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        });

        PDF::SetMargins(5, 20, 5); //SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        PDF::SetAutoPageBreak(TRUE, 11); //margin boton del documento

        // ---------------------------------------------------------
        // add a page
        PDF::AddPage('L', 'A4');
        PDF::SetFont('helvetica', '', 8);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output("reporte.pdf", 'I');
    }
}
