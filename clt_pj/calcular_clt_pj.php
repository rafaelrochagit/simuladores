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

$certificadoDigital = moneyToNumber($form['certificado_digital']);
$contador = moneyToNumber($form['contador']);
$planoSaude = moneyToNumber($form['plano_saude']);
$planoOdontologico = moneyToNumber($form['plano_odontologico']);
$aliquotaSimples = percentToNumber($form['aliquota_simples']);
$descontosPJ = getFromArray($form, 'descontosPJ', array());
$beneficiosPJ = getFromArray($form, 'beneficiosPJ', array());

$faturamentoBruto = $cltPj->cltPjEquivalente(
    $salarioLiquidoFinal, $aliquotaSimples, $descontosPJ, $beneficiosPJ, 
    $certificadoDigital, $contador, $planoSaude, $planoOdontologico
);

$form['faturamento_bruto'] = numberToMoney($faturamentoBruto);

$clt->formSimulacao($form);
$pj->formSimulacao($form);
/*
debug($clt->salarioLiquidoFinal($salarioBruto, $numeroDependentes, $valorPensao, 
$descontos, $descontoAlimentacao, $descontoRefeicao,
$beneficios, $auxilioAlimentacao, $auxilioRefeicao));
*/

$simulacao['codSimulacaoClt'] = $codSimulacaoClt;
$simulacao['codSimulacaoPj'] = $codSimulacaoPj;
$simulacao['salarioBruto'] = $salarioBruto;
$simulacao['faturamentoBruto'] = numberToMoney($faturamentoBruto);
$simulacao['dataSimulacao'] = date('Y-m-d H:i:s');
$simulacoes = $cltPj->readSimulacoes();
$simulacoes['simulacaoCLT'.$codSimulacaoClt.'PJ'.$codSimulacaoPj] = $simulacao;
$cltPj->salvarSimulacoes($simulacoes);

header("Location: index.php?codSimulacaoClt=" . $codSimulacaoClt . "&codSimulacaoPj=". $codSimulacaoPj);





?>