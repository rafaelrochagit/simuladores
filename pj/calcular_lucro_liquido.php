<?php require_once '../shared.php'; ?>
<?php require_once '../util.php'; ?>
<div class="col">
    <a href="index.php" class="btn btn-success">Nova Simulação</a>
</div>
<?php
$form = $_POST;
$codSimulacaoPj = isset($form['codSimulacaoPj']) ? $form['codSimulacaoPj'] : '';
$pj->formSimulacao($form);
/*
    debug($pj->faturamentoLiquidoFinal(
        $faturamentoBruto, $aliquotaSimples, $descontos, $beneficios, 
        $certificadoDigital, $contador, $planoSaude, $planoOdontologico
        )
    );
    */
header("Location: index.php?codSimulacaoPj=" . $codSimulacaoPj . "#resultPj");





?>