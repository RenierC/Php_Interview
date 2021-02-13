<?php
// Entrada de endpoint para filtrar por rango de precio
// endpoint de prueba http://localhost/PHP_interview/api/rango.php?min=2&max=10
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Rango.php";

$database = new Database();
$db = $database->connect();

$rango = new Rango($db);

if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    $max = $_GET["max"];
}

$result = $rango->consulta($min, $max)->fetchAll();

print_r(json_encode($result));
