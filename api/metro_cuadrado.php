<?php
// Entrada de api para calcular el preco del metro cuadrado
// endpoint de prueba http://localhost/PHP_interview/api/metro_cuadrado.php?lat=40.3658&long=-3.58845&distancia=10
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Metro.php";

$database = new Database();
$db = $database->connect();

$rango = new Metro($db);

if (isset($_GET["lat"]) && isset($_GET["long"]) && isset($_GET["distancia"])) {
    $lat = $_GET["lat"];
    $long = $_GET["long"];
    $distancia = $_GET["distancia"];
}
// Agrego el [0] porque me regresa un array
$result = $rango->consulta($lat, $long, $distancia)->fetch()[0];
// Convertir de nuevo en numero
$total = (float) $result;
print_r(json_encode($total));
