<?php
// Filtra la bd por cantidad de habitaciones
class Vivienda
{
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read($nroHab)
    {
        $query = "SELECT * FROM viviendas WHERE habitaciones = :parameter";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":parameter", $nroHab, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }
}
