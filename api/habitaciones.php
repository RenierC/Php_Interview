<?php
// entrada de api para filtrar por numero de habitaciones
// endpoint de prueba http://localhost/PHP_interview/api/habitaciones.php?habitaciones=2
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../config/Database.php";
include_once "../models/Viviendas.php";

// Instaciar DB & conectar
$database = new Database();
$db = $database->connect();

$vivienda = new Vivienda($db);

if (isset($_GET["habitaciones"])) {
    $nroHab = $_GET["habitaciones"];
}

$result = $vivienda->read($nroHab)->fetchAll();

print_r(json_encode($result));
