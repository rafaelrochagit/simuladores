<?php require_once '../shared.php'; ?>
<?php require_once '../util.php'; ?>
<div class="col">
    <a href="index.php" class="btn btn-success">Nova Simulação</a>
</div>
<?php

$form = $_POST;
$codSimulacaoClt = isset($form['codSimulacaoClt']) ? $form['codSimulacaoClt'] : '';
$codSimulacaoMei = isset($form['codSimulacaoMei']) ? $form['codSimulacaoMei'] : '';

//$clt->formSimulacao($form);
//$mei->formSimulacao($form);
$salarioBruto = $form['salario_bruto'];
$numeroDependentes = $form['numero_dependentes'];
$valorPensao = $form['valor_pensao'];

$descontosCLT = getFromArray($form, 'descontosCLT', array());
$beneficiosCLT = getFromArray($form, 'beneficiosCLT', array());

$auxilioAlimentacao = moneyToNumber($form['auxilio_alimentacao']);
$descontoAlimentacao = moneyToNumber($form['desconto_alimentacao']);
$auxilioRefeicao = moneyToNumber($form['auxilio_refeicao']);
$descontoRefeicao = moneyToNumber($form['desconto_refeicao']);
$plr = moneyToNumber($form['plr']);

$descontoTransporte = 0;
if(isset($form['auxilio_transporte_check']) && $form['auxilio_transporte_check']) {
    $descontoTransporte = moneyToNumber($salarioBruto)*0.06;
}
$auxilioTransporte = moneyToNumber($form['auxilio_transporte']);

$valorSindicatoAnual = 0;
if(isset($form['sindicato_check']) && $form['sindicato_check']) {
    $valorSindicatoAnual = moneyToNumber($salarioBruto)/30;
}

$valorSindicatoMensal = $valorSindicatoAnual/12;

$salarioLiquidoFinal = $clt->salarioLiquidoFinal( 
    $salarioBruto,
    $numeroDependentes,
    $valorPensao,
    $descontosCLT,
    $descontoAlimentacao,
    $descontoRefeicao,
    $beneficiosCLT,
    $auxilioAlimentacao,
    $auxilioRefeicao,
    $descontoTransporte,
    $auxilioTransporte,
    $plr,
    $valorSindicatoMensal
);

$das = moneyToNumber($form['das']);
$descontosMEI = getFromArray($form, 'descontosMEI', array());
$beneficiosMEI = getFromArray($form, 'beneficiosMEI', array());

$faturamentoBruto = $cltMei->cltMeiEquivalente(
    $salarioLiquidoFinal, $das, $descontosMEI, $beneficiosMEI
);

$form['faturamento_bruto'] = numberToMoney($faturamentoBruto);

$clt->formSimulacao($form);
$mei->formSimulacao($form);
/*
debug($clt->salarioLiquidoFinal($salarioBruto, $numeroDependentes, $valorPensao, 
$descontos, $descontoAlimentacao, $descontoRefeicao,
$beneficios, $auxilioAlimentacao, $auxilioRefeicao));
*/

$simulacao['codSimulacaoClt'] = $codSimulacaoClt;
$simulacao['codSimulacaoMei'] = $codSimulacaoMei;
$simulacao['salarioBruto'] = $salarioBruto;
$simulacao['faturamentoBruto'] = numberToMoney($faturamentoBruto);
$simulacao['dataSimulacao'] = date('Y-m-d H:i:s');
$simulacoes = $cltMei->readSimulacoes();
$simulacoes['simulacaoCLT'.$codSimulacaoClt.'MEI'.$codSimulacaoMei] = $simulacao;
$cltMei->salvarSimulacoes($simulacoes);

header("Location: index.php?codSimulacaoClt=" . $codSimulacaoClt . "&codSimulacaoMei=". $codSimulacaoMei);





?>