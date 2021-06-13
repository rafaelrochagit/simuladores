<?php
header('Cache-Control: no-cache, must-revalidate'); 
header('Content-Type: application/json; charset=utf-8');

require_once "IRPF_PLR.php";

$irpf = new IRPF_PLR();

$tabelaNome = $_GET['tabelaNome'];

$irpf->selecionar($tabelaNome);

session_start();
$_SESSION["msgSuccess"] = "Tabela ".$tabelaNome." selecionada com sucesso!";
header("Location: tabelas_irpf_plr_lista.php");