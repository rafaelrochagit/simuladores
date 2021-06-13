<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "INSS.php";

$inss = new INSS();

$tabelaNome = $_GET['tabelaNome'];

$inss->selecionar($tabelaNome);

session_start();
$_SESSION["msgSuccess"] = "Tabela ".$tabelaNome." selecionada com sucesso!";
header("Location: tabelas_inss_lista.php");