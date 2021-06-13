<?php
require_once 'MEI.php'; 
session_start();
$mei = new MEI();
$simulacoesMei = $mei->readSimulacoes();
$codSimulacaoMeiAtual = isset($_GET['codSimulacaoMei']) ? $_GET['codSimulacaoMei'] : null;
if($codSimulacaoMeiAtual != null) {
    unset($simulacoesMei['meiLiquido'.$codSimulacaoMeiAtual]);
    $mei->salvarSimulacoes($simulacoesMei);
    $_SESSION["msgSuccess"] = "Simulação ".$codSimulacaoMeiAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>