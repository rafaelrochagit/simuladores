<?php require_once '../shared.php'; ?>
<?php require_once '../util.php'; ?>
<div class="col">
    <a href="index.php" class="btn btn-success">Nova Simulação</a>
</div>
<?php

$form = $_POST;
$codSimulacaoClt = isset($form['codSimulacaoClt']) ? $form['codSimulacaoClt'] : '';

$clt->formSimulacao($form);
/*
debug($clt->salarioLiquidoFinal($salarioBruto, $numeroDependentes, $valorPensao, 
$descontos, $descontoAlimentacao, $descontoRefeicao,
$beneficios, $auxilioAlimentacao, $auxilioRefeicao));
*/
header("Location: index.php?codSimulacaoClt=" . $codSimulacaoClt . "#resultClt");





?>