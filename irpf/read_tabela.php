<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "IRPF.php";

$irpf = new IRPF();

$tabelaNome = $_POST['tabelaNome'];

$response = $irpf->readJson($tabelaNome);

echo $response;