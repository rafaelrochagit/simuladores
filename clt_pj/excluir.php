<?php
require_once 'CLT_PJ.php'; 
session_start();
$cltPj = new CLT_PJ();
$simulacoes = $cltPj->readSimulacoes();
$codSimulacaoCltAtual = isset($_GET['codSimulacaoClt']) ? $_GET['codSimulacaoClt'] : null;
$codSimulacaoPjAtual = isset($_GET['codSimulacaoPj']) ? $_GET['codSimulacaoPj'] : null;
if($codSimulacaoCltAtual != null && $codSimulacaoPjAtual != null ) {
    unset($simulacoes['simulacaoCLT'.$codSimulacaoCltAtual."PJ".$codSimulacaoPjAtual]);
    $cltPj->salvarSimulacoes($simulacoes);
    $_SESSION["msgSuccess"] = "Simulação CLT: ".$codSimulacaoCltAtual." PJ: ".$codSimulacaoPjAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>