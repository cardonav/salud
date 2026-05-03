<?php
require('fpdf.php');
include("config/db.php");

session_start();
if (!isset($_SESSION['u'])) {
    header("Location: login.php");
    exit;
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(58, 12, 163);
        $this->Cell(0, 15, 'COSFA SALUD - REPORTE DE HISTORIAS CLINICAS', 0, 1, 'C');
        $this->Ln(5);

        // Header table
        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(67, 97, 238);
        $this->SetTextColor(255);
        $this->Cell(25, 10, 'Fecha', 1, 0, 'C', true);
        $this->Cell(45, 10, 'Estudiante', 1, 0, 'C', true);
        $this->Cell(60, 10, 'Sintomas', 1, 0, 'C', true);
        $this->Cell(60, 10, 'Tratamiento', 1, 1, 'C', true);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0);

$query = "SELECT h.*, e.nombre as estudiante_nombre FROM historia h JOIN estudiantes e ON h.estudiante_id = e.id ORDER BY h.fecha DESC";
$r = $conn->query($query);

if ($r && $r->num_rows > 0) {
    while ($row = $r->fetch_assoc()) {
        $fecha = date('d/m/Y', strtotime($row['fecha']));
        $nombre = utf8_decode(substr($row['estudiante_nombre'], 0, 20));
        $sintomas = utf8_decode(substr($row['sintomas'], 0, 30));
        $tratamiento = utf8_decode(substr($row['tratamiento'], 0, 30));

        $pdf->Cell(25, 10, $fecha, 1, 0, 'C');
        $pdf->Cell(45, 10, $nombre, 1, 0, 'L');
        $pdf->Cell(60, 10, $sintomas, 1, 0, 'L');
        $pdf->Cell(60, 10, $tratamiento, 1, 1, 'L');
    }
} else {
    $pdf->Cell(190, 10, 'No hay registros disponibles', 1, 1, 'C');
}

$pdf->Output('I', 'Reporte_COSFA_SALUD.pdf');
?>