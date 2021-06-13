<?php
ob_start();
require_once "INSS.php";

$faixa1 = $_POST['faixa1'];
$faixa2 = $_POST['faixa2'];
$faixa3 = $_POST['faixa3'];
$faixa4 = $_POST['faixa4'];
$teto = $_POST['teto'];
var_dump($faixa1);
echo '<br><br>';
var_dump($faixa2);
echo '<br><br>';
var_dump($faixa3);
echo '<br><br>';
var_dump($faixa4);
echo '<br><br>';
var_dump($teto);

$tabela['faixa1'] = $faixa1;
$tabela['faixa2'] = $faixa2;
$tabela['faixa3'] = $faixa3;
$tabela['faixa4'] = $faixa4;
$tabela['teto'] = $teto;

if(
	faixaPrenchida($faixa1) &&
	faixaPrenchida($faixa2) &&
	faixaPrenchida($faixa3) &&
	faixaPrenchida($faixa4) &&
	$teto != ""
) {
	$inss = new INSS();
	$inss->salvar($tabela);
	header("Location: tabelas_inss_lista.php");
} else {
	session_start();
	$_SESSION["msg"] = "Todos os campos devem ser preenchidos e válidos";
	$_SESSION["erroForm"] = $tabela;
	header("Location: tabela_inss.php");
}

function faixaPrenchida($faixa) {
	if(	
		$faixa['piso'] != "" && 
		$faixa['teto'] != "" && 
		$faixa['percent'] != "" && 
		$faixa["max"] != ""
	) {
		return true;
	}
	return false;
}