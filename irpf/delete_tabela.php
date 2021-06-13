<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "IRPF.php";

$inss = new IRPF();

$tabelaNome = $_GET['tabelaNome'];

$inss->delete($tabelaNome);

session_start();
$_SESSION["msgSuccess"] = "Tabela ".$tabelaNome." deletada com sucesso!";
header("Location: tabelas_irpf_lista.php");