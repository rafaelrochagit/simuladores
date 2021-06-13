<?php require_once '../shared.php'; ?>
<?php require_once '../util.php'; ?>
<div class="col">
    <a href="index.php" class="btn btn-success">Nova Simulação</a>
</div>
<?php
$form = $_POST;
$codSimulacaoJc = isset($form['codSimulacaoJc']) ? $form['codSimulacaoJc'] : '';

$jc->formSimulacao($form);
/*
    debug($mei->faturamentoLiquidoFinal(
        $faturamentoBruto, $aliquotaSimples, $descontos, $beneficios, 
        $certificadoDigital, $contador, $planoSaude, $planoOdontologico
        )
    );
    */
header("Location: index.php?codSimulacaoJc=" . $codSimulacaoJc . "#resultJc");





?>