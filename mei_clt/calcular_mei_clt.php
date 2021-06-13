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
$faturamentoBruto = $form['faturamento_bruto'];
$numeroDependentes = $form['numero_dependentes'];
$valorPensao = $form['valor_pensao'];

$descontosCLT = getFromArray($form, 'descontosCLT', array());
$beneficiosCLT = getFromArray($form, 'beneficiosCLT', array());

$auxilioAlimentacao = moneyToNumber($form['auxilio_alimentacao']);
$descontoAlimentacao = moneyToNumber($form['desconto_alimentacao']);
$auxilioRefeicao = moneyToNumber($form['auxilio_refeicao']);
$descontoRefeicao = moneyToNumber($form['desconto_refeicao']);
$plr = moneyToNumber($form['plr']);

$das = moneyToNumber($form['das']);
$descontosMEI = getFromArray($form, 'descontosMEI', array());
$beneficiosMEI = getFromArray($form, 'beneficiosMEI', array());

$auxilio_transporte_check = false;
if(isset($form['auxilio_transporte_check']) && $form['auxilio_transporte_check']) {
    $auxilio_transporte_check = true;
}

$sindicato_check = false;
if(isset($form['sindicato_check']) && $form['sindicato_check']) {
    $sindicato_check = true;
}


$auxilioTransporte = moneyToNumber($form['auxilio_transporte']);

$faturamentoLiquidoFinal = $mei->faturamentoLiquidoFinal(
    $faturamentoBruto, 
    $das, 
    $descontosMEI, 
    $beneficiosMEI 
);

$salarioBruto = $meiClt->meiCltEquivalente(
    $faturamentoLiquidoFinal, 
    $numeroDependentes,
    $valorPensao,
    $descontosCLT,
    $descontoAlimentacao,
    $descontoRefeicao,
    $beneficiosCLT,
    $auxilioAlimentacao,
    $auxilioRefeicao,
    0,
    $auxilioTransporte,
    $auxilio_transporte_check,
    $plr,
    $sindicato_check
);

$form['salario_bruto'] = numberToMoney($salarioBruto);

$clt->formSimulacao($form);
$mei->formSimulacao($form);
/*
debug($clt->salarioLiquidoFinal($salarioBruto, $numeroDependentes, $valorPensao, 
$descontos, $descontoAlimentacao, $descontoRefeicao,
$beneficios, $auxilioAlimentacao, $auxilioRefeicao));
*/

$simulacao['codSimulacaoClt'] = $codSimulacaoClt;
$simulacao['codSimulacaoMei'] = $codSimulacaoMei;
$simulacao['salarioBruto'] = numberToMoney($salarioBruto);
$simulacao['faturamentoBruto'] = $faturamentoBruto;
$simulacao['dataSimulacao'] = date('Y-m-d H:i:s');
$simulacoes = $meiClt->readSimulacoes();
$simulacoes['simulacaoCLT'.$codSimulacaoClt.'MEI'.$codSimulacaoMei] = $simulacao;
$meiClt->salvarSimulacoes($simulacoes);

header("Location: index.php?codSimulacaoClt=" . $codSimulacaoClt . "&codSimulacaoMei=". $codSimulacaoMei);





?>