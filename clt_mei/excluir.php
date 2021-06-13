<?php
require_once 'CLT_MEI.php'; 
session_start();
$cltMei = new CLT_MEI();
$simulacoes = $cltMei->readSimulacoes();
$codSimulacaoCltAtual = isset($_GET['codSimulacaoClt']) ? $_GET['codSimulacaoClt'] : null;
$codSimulacaoMeiAtual = isset($_GET['codSimulacaoMei']) ? $_GET['codSimulacaoMei'] : null;
if($codSimulacaoCltAtual != null && $codSimulacaoMeiAtual != null ) {
    unset($simulacoes['simulacaoCLT'.$codSimulacaoCltAtual."MEI".$codSimulacaoMeiAtual]);
    $cltMei->salvarSimulacoes($simulacoes);
    $_SESSION["msgSuccess"] = "Simulação CLT: ".$codSimulacaoCltAtual." MEI: ".$codSimulacaoMeiAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>