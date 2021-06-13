<?php
require_once 'PJ.php'; 
session_start();
$pj = new PJ();
$simulacoesPj = $pj->readSimulacoes();
$codSimulacaoPjAtual = isset($_GET['codSimulacaoPj']) ? $_GET['codSimulacaoPj'] : null;
if($codSimulacaoPjAtual != null) {
    unset($simulacoesPj['pjLiquido'.$codSimulacaoPjAtual]);
    $pj->salvarSimulacoes($simulacoesPj);
    $_SESSION["msgSuccess"] = "Simulação ".$codSimulacaoPjAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>