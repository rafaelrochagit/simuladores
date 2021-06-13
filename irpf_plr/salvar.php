<?php
ob_start();
require_once "IRPF_PLR.php";

$faixa1 = $_POST['faixa1'];
$faixa2 = $_POST['faixa2'];
$faixa3 = $_POST['faixa3'];
$faixa4 = $_POST['faixa4'];
$teto = $_POST['faixa5'];
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
$tabela['faixa5'] = $teto;

if(
	faixaPrenchida($faixa1) &&
	faixaPrenchida($faixa2) &&
	faixaPrenchida($faixa3) &&
	faixaPrenchida($faixa4) &&
	$teto != ""
) {
	$irpf = new IRPF_PLR();
	$irpf->salvar($tabela);
	header("Location: tabelas_irpf_plr_lista.php");
} else {
	session_start();
	$_SESSION["msg"] = "Todos os campos devem ser preenchidos e válidos";
	$_SESSION["erroForm"] = $tabela;
	header("Location: tabela_irpf_plr.php");
}

function faixaPrenchida($faixa) {
	if(	
		$faixa['piso'] != "" && 
		$faixa['teto'] != "" && 
		$faixa['percent'] != "" && 
		$faixa["deducao"] != ""
	) {
		return true;
	}
	return false;
}