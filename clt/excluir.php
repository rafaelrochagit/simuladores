<?php
require_once 'CLT.php'; 
session_start();
$clt = new CLT();
$simulacoesClt = $clt->readSimulacoes();
$codSimulacaoCltAtual = isset($_GET['codSimulacaoClt']) ? $_GET['codSimulacaoClt'] : null;
if($codSimulacaoCltAtual != null) {
    unset($simulacoesClt['cltLiquido'.$codSimulacaoCltAtual]);
    $clt->salvarSimulacoes($simulacoesClt);
    $_SESSION["msgSuccess"] = "Simulação ".$codSimulacaoCltAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>