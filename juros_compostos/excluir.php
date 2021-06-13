<?php
require_once 'JC.php'; 
session_start();
$jc = new JC();
$simulacoesJc = $jc->readSimulacoes();
$codSimulacaoJcAtual = isset($_GET['codSimulacaoJc']) ? $_GET['codSimulacaoJc'] : null;
if($codSimulacaoJcAtual != null) {
    unset($simulacoesJc['jc'.$codSimulacaoJcAtual]);
    $jc->salvarSimulacoes($simulacoesJc);
    $_SESSION["msgSuccess"] = "Simulação ".$codSimulacaoJcAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>