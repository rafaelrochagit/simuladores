<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "IRPF.php";

$irpf = new IRPF();

$tabelaNome = $_GET['tabelaNome'];

$irpf->selecionar($tabelaNome);

session_start();
$_SESSION["msgSuccess"] = "Tabela ".$tabelaNome." selecionada com sucesso!";
header("Location: tabelas_irpf_lista.php");