<?php
require('fpdf/fpdf.php');
require_once("../CapaDato/fichaDAO.php");
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../CapaPresentacion/assets/img/logo_redondo.jpg', 10, 8, 20);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 10, 'Reporte de Fichas Emitidas', 0, 1, 'C');
        $this->Ln(25);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    function FancyTable($header, $data)
    {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $w = array(30, 40, 40, 40, 40, 30);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id_ficha'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['nombre_especialidad'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['nombre_medico'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['nombre_paciente'], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['apellido_paciente'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['fecha_atencion'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
$database = new Database;
$fichaDAO = new fichaDAO($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectEspecialidad = $_POST["selectEspecialidad"];
    $fechaInicio = $_POST["fechaInicio"];
    $fichas = $fichaDAO->obtenerFichasPorCriterios($selectEspecialidad, $fechaInicio);
    $pdf = new PDF('L');
    $pdf->AddPage();
    $header = array('ID Ficha', 'Especialidad', 'Nombre Medico', 'Nombre del Paciente', 'Apellido', 'Fecha Atencion');
    $pdf->FancyTable($header, $fichas);
    $pdf->Output();
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>
