<?php
// Calcula el rango de precios basado en min y max
class Rango
{
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function consulta($min, $max)
    {
        $query =
            "SELECT * FROM viviendas WHERE precio >= :minimo AND precio <= :maximo";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([":minimo" => $min, ":maximo" => $max]);

        return $stmt;
    }
}
