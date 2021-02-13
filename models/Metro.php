<?php
// Calcula el precio del metro cuadrado
class Metro
{
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Funcion que consulta el precio del metro cuadrado usando lat long y km
    public function consulta($lat, $long, $distancia)
    {
        // Este query hace todo el trabajo sucio
        // Calcula area del circulo usando las variables y genera una distancia
        // despues se hace un subquery con la distancia para
        // Calcular todo el promedio
        $query = 'SELECT AVG(precio_metro) FROM (SELECT
    *,
    ( 6371 * acos( cos( radians(:lat) ) * cos( radians( `latitud` ) ) * cos( radians( `longitud` ) - radians(:long) ) + sin( radians(:lat) ) * sin( radians( `latitud` ) ) ) ) AS distance
FROM viviendas
HAVING distance <= :distancia) T
';
        $stmt = $this->conn->prepare($query);
        // Reemplaza los wildcards del query por las variables
        $stmt->execute([
            ":lat" => $lat,
            ":long" => $long,
            ":distancia" => $distancia,
        ]);

        return $stmt;
    }
}
