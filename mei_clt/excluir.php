<?php
require_once 'MEI_CLT.php'; 
session_start();
$meiClt = new MEI_CLT();
$simulacoes = $meiClt->readSimulacoes();
$codSimulacaoCltAtual = isset($_GET['codSimulacaoClt']) ? $_GET['codSimulacaoClt'] : null;
$codSimulacaoMeiAtual = isset($_GET['codSimulacaoMei']) ? $_GET['codSimulacaoMei'] : null;
if($codSimulacaoCltAtual != null && $codSimulacaoMeiAtual != null ) {
    unset($simulacoes['simulacaoCLT'.$codSimulacaoCltAtual."MEI".$codSimulacaoMeiAtual]);
    $meiClt->salvarSimulacoes($simulacoes);
    $_SESSION["msgSuccess"] = "Simulação CLT: ".$codSimulacaoCltAtual." MEI: ".$codSimulacaoMeiAtual." excluída com sucesso!";
} else {
    $_SESSION["msg"] = "Simulação não encontrada";
}
header("Location: lista_simulacoes.php");
?>