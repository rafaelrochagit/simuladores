<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "INSS.php";

$inss = new INSS();

$tabelaNome = $_POST['tabelaNome'];

$response = $inss->readJson($tabelaNome);

echo $response;