<?php require_once '../shared.php'; ?>
<?php require_once '../util.php'; ?>
<div class="col">
    <a href="index.php" class="btn btn-success">Nova Simulação</a>
</div>
<?php

$form = $_POST;
$codSimulacaoClt = isset($form['codSimulacaoClt']) ? $form['codSimulacaoClt'] : '';
$codSimulacaoPj = isset($form['codSimulacaoPj']) ? $form['codSimulacaoPj'] : '';

//$clt->formSimulacao($form);
//$pj->formSimulacao($form);
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

$certificadoDigital = moneyToNumber($form['certificado_digital']);
$contador = moneyToNumber($form['contador']);
$planoSaude = moneyToNumber($form['plano_saude']);
$planoOdontologico = moneyToNumber($form['plano_odontologico']);
$aliquotaSimples = percentToNumber($form['aliquota_simples']);
$descontosPJ = getFromArray($form, 'descontosPJ', array());
$beneficiosPJ = getFromArray($form, 'beneficiosPJ', array());

$faturamentoLiquidoFinal = $pj->faturamentoLiquidoFinal(
    $faturamentoBruto, 
    $aliquotaSimples, 
    $descontosPJ, 
    $beneficiosPJ, 
    $certificadoDigital, 
    $contador, $planoSaude, 
    $planoOdontologico
);

$auxilio_transporte_check = false;
if(isset($form['auxilio_transporte_check']) && $form['auxilio_transporte_check']) {
    $auxilio_transporte_check = true;
}

$sindicato_check = false;
if(isset($form['sindicato_check']) && $form['sindicato_check']) {
    $sindicato_check = true;
}

$auxilioTransporte = moneyToNumber($form['auxilio_transporte']);
$salarioBruto = $pjClt->pjCltEquivalente(
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
$pj->formSimulacao($form);
/*
debug($clt->salarioLiquidoFinal($salarioBruto, $numeroDependentes, $valorPensao, 
$descontos, $descontoAlimentacao, $descontoRefeicao,
$beneficios, $auxilioAlimentacao, $auxilioRefeicao));
*/

$simulacao['codSimulacaoClt'] = $codSimulacaoClt;
$simulacao['codSimulacaoPj'] = $codSimulacaoPj;
$simulacao['salarioBruto'] = numberToMoney($salarioBruto);
$simulacao['faturamentoBruto'] = $faturamentoBruto;
$simulacao['dataSimulacao'] = date('Y-m-d H:i:s');
$simulacoes = $pjClt->readSimulacoes();
$simulacoes['simulacaoCLT'.$codSimulacaoClt.'PJ'.$codSimulacaoPj] = $simulacao;
$pjClt->salvarSimulacoes($simulacoes);

header("Location: index.php?codSimulacaoClt=" . $codSimulacaoClt . "&codSimulacaoPj=". $codSimulacaoPj);





?>