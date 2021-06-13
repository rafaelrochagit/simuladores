<?php
require_once 'PONTO.php'; 
session_start();
$ponto = new PONTO();
$simulacoesPonto = $ponto->readSimulacoes();
$codSimulacaoPontoAtual = isset($_GET['codSimulacaoPonto']) ? $_GET['codSimulacaoPonto'] : null;
if($codSimulacaoPontoAtual != null) {
    unset($simulacoesPonto['ponto'.$codSimulacaoPontoAtual]);
    $ponto->salvarSimulacoes($simulacoesPonto);
    $_SESSION["msgSuccess"] = "Simulação ".$codSimulacaoPontoAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>