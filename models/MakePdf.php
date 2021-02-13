<?php
// Convierte a pdf
require "../fpdf/fpdf.php";

class PDF extends FPDF
{
    function Header()
    {
        // Setup de como se ve el header
        $this->SetFont("Arial", "B", 15);
        $this->Cell(70);
        $this->Cell(60, 10, "Reporte Inmobiliario", 1, 0, "C");
        $this->Ln(20);

        // Las columnas a mostar
        $this->Cell(48, 10, "Id vivienda", 1, 0, "C", 0);
        $this->Cell(48, 10, "Latitud", 1, 0, "C", 0);
        $this->Cell(48, 10, "Longitud", 1, 0, "C", 0);
        $this->Cell(48, 10, "Precio", 1, 1, "C", 0);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "I", 8);
        $this->Cell(
            0,
            10,
            utf8_decode("Página ") . $this->PageNo() . "/{nb}",
            0,
            0,
            "C"
        );
    }

    function generate($filtro, $valor)
    {
        $this->AliasNbPages();
        $this->AddPage();
        $this->SetFont("Arial", "", 12);

        $conn = mysqli_connect("localhost", "root", "", "viviendadb");
        $query = "SELECT * FROM viviendas WHERE {$filtro} = '{$valor}'";
        $result = mysqli_query($conn, $query);

        while ($row = $result->fetch_assoc()) {
            $this->Cell(48, 10, $row["id_vivienda"], 1, 0, "C", 0);
            $this->Cell(48, 10, $row["latitud"], 1, 0, "C", 0);
            $this->Cell(48, 10, $row["longitud"], 1, 0, "C", 0);
            $this->Cell(48, 10, $row["precio"], 1, 1, "C", 0);
        }

        $this->Output();
        // Forza descarga en el browser
        $this->Output("D", "reporte.pdf");
        // Guarda una copia en el root del server
        $this->Output("F", $_SERVER["DOCUMENT_ROOT"] . "/reporte.pdf");
    }
}
?>
