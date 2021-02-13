<?php
// Entrada para generar reporte CSV y PDF
// endpoint de prueba http://localhost/PHP_interview/api/reporte.php?filtro=habitaciones&valor=3&tipo=pdf
include_once "../models/MakePdF.php";
include_once "../models/MakeCSV.php";
include_once "../config/Database.php";

$filtro = $_GET["filtro"];
$valor = $_GET["valor"];
$tipo = $_GET["tipo"];

$database = new Database();
$db = $database->connect();

// Chequea que los 3 parametros necesarios esten en el url para poder correr la funcion
if (isset($_GET["valor"]) && isset($_GET["valor"]) && $_GET["tipo"] === "pdf") {
    $data = new PDF();
    $result = $data->generate($filtro, $valor);
}

if (isset($_GET["valor"]) && isset($_GET["valor"]) && $_GET["tipo"] === "csv") {
    $csv = new CSV($db);
    $myConversion = $csv->convert($filtro, $valor);
}
