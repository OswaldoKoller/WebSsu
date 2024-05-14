<?php
require('fpdf/fpdf.php');
require_once("../CapaDato/citaMedicaDAO.php");

class PDF extends FPDF
{
    function Header()
{
    // Logo
    $this->Image('../CapaPresentacion/assets/img/logo_redondo.jpg', 10, 8, 33);
    
    $this->SetFont('Arial', 'B', 18);
    $this->ln(10);
    $this->Cell(0, 10, 'Historia Clinica', 0, 1, 'C');
    $this->Ln(25);
}

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function PatientInfo($patient_name)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Datos del Paciente', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 8, 'Nombre: ' . $patient_name, 0, 1, 'L');
        $this->Ln(5);
    }

    function FancyTable($header, $data)
    {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $w = array(30, 60, 40, 40, 30);

        for ($i = 0; $i < count($header) - 1; $i++) { // Excluir la columna 'Tratamiento'
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }

        $this->Ln();
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;

        foreach ($data as $row) {
            
            $this->Cell($w[0], 6, 'ID Cita: ' . $row['id_cita'], 0, 0, 'L');
            $this->Ln();

            $this->Cell($w[1], 6, 'Motivo: ' . $row['motivo'], 0, 0, 'L');
            $this->Ln();

            $this->Cell($w[2], 6, 'Diagnostico: ' . $row['diagnostico'], 0, 0, 'L');
            $this->Ln();

            $this->Cell($w[3], 6, 'Indicacion: ' . $row['indicacion'], 0, 0, 'L');
            $this->Ln();

            $this->Cell($w[4], 6, 'Fecha Emision: ' . $row['fecha_emision'], 0, 0, 'L');
            $this->Ln();

            // Verificar si hay suficiente espacio para la próxima fila, si no, agregar una nueva página
            $lineHeight = 6; // Ajusta según sea necesario
            if ($this->GetY() + $lineHeight > $this->PageBreakTrigger - 20) {
                $this->AddPage();
                $this->PatientInfo($data[0]['nombre_paciente']);
                $this->Cell(array_sum($w), 0, ''); // Salto de línea para evitar superposición con la tabla
            }

            $fill = !$fill;
        }
    }
}

$database = new Database;
$citaMedicaDAO = new CitaMedicaDAO($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = $_POST["id_paciente"];
    $citas_medicas = $citaMedicaDAO->obtenerCitasMedicasPorPaciente($id_paciente);

    if (!empty($citas_medicas)) {
        $patient_name = $citas_medicas[0]['nombre_paciente'];
        $header = array('DATOS DE HISTORIA CLINICA');

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->PatientInfo($patient_name);
        $pdf->FancyTable($header, $citas_medicas);
        $pdf->Output();
    } else {
        echo "Error: No se encontraron datos para el paciente.";
    }
} else {
    echo "Error: No se recibieron datos del formulario.";
}
?>

