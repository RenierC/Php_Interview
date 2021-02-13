<?php
// Convierte a csv
class CSV
{
    // Importacion de coneccion
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function convert($filtro, $valor)
    {
        $sql = "SELECT * FROM viviendas WHERE {$filtro} = '{$valor}'";

        $statement = $this->conn->prepare($sql);

        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Nombre de columnas
        $columnNames = [];
        if (!empty($rows)) {
            $firstRow = $rows[0];
            foreach ($firstRow as $colName => $val) {
                $columnNames[] = $colName;
            }
        }

        $fileName = "reporte.csv";

        header("Content-Type: application/excel");
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Variable para guardar desde explorador
        $fp = fopen("php://output", "w");
        // Variable para guardar una copia en el server
        $saveServer = fopen($_SERVER["DOCUMENT_ROOT"] . "/" . $fileName, "w");

        fputcsv($fp, $columnNames);
        fputcsv($saveServer, $columnNames);

        foreach ($rows as $row) {
            fputcsv($fp, $row);
            fputcsv($saveServer, $row);
        }

        fclose($fp);
    }
}
