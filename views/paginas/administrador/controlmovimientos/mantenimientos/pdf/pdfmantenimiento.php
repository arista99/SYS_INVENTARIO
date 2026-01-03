<?php
function texto($str)
{
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str ?? '');
}
// Cabecera de página
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// PLANTILLA
$pdf->Image('public/img/formato_mantenimiento.PNG', 0, 0, 210);

// FUENTE
$pdf->SetFont('Arial', '',18);

// ====== DATOS DEL EQUIPO - FECHA INICIO ======
$pdf->SetXY(20, 35);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->fecha_inicio), 0);

// ====== DATOS DEL EQUIPO - FECHA FIN ======
$pdf->SetXY(70, 35);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->fecha_fin), 0);

// ====== DATOS DEL EQUIPO - NRO REPORTE ======
$pdf->SetXY(140, 35);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->id), 0);

// ====== DATOS DEL EQUIPO - USUARIO SOPORTE ======
$pdf->SetXY(20, 60);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->nombre), 0);

// ====== DATOS DEL EQUIPO - NUMERO SOPORTE ======
$pdf->SetXY(140, 60);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->numero), 0);

// ====== DATOS DEL EQUIPO - USUARIO RESPONSABLE ======
$pdf->SetXY(20, 85);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->usuario_responsable), 0);

// ====== DATOS DEL EQUIPO - NUMERO RESPONSABLE ======
$pdf->SetXY(140, 85);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->numero_usuario), 0);

// ====== DATOS DEL EQUIPO - NOMBRE EQUIPO ======
$pdf->SetFont('Arial', '',12);
$pdf->SetXY(6, 110);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->nom_equipo), 0);

// ====== DATOS DEL EQUIPO - Marca ======
$pdf->SetXY(40, 108);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->fabricante), 0);

// ====== DATOS DEL EQUIPO - Modelo ======
$pdf->SetXY(40, 115);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->modelo), 0);

// ====== DATOS DEL EQUIPO - Disco ======
$pdf->SetXY(90, 110);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->disco), 0);

// ====== DATOS DEL EQUIPO - Procesador ======
$pdf->SetXY(130, 110);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->procesador), 0);

// ====== DATOS DEL EQUIPO - Ram ======
$pdf->SetXY(180, 110);
$pdf->Cell(80, 5, texto($dataMantenimientoaPDF->memoria), 0);

// ====== DATOS DEL EQUIPO - Descripcion ======
$pdf->SetXY(10, 135);
$pdf->MultiCell(90, 5, texto($dataMantenimientoaPDF->descripcion), 0, 'L');

// ====== DATOS DEL EQUIPO - Observacion ======
$pdf->SetXY(105, 135);
$pdf->MultiCell(90, 5, texto($dataMantenimientoaPDF->observacion), 0,'L');


$pdf->Output();