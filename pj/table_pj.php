<?php
$form = getFromArray($pjLiquido, 'form');
$faturamento_bruto = getFromArray($form, 'faturamento_bruto', '0,00');
$certificado_digital = getFromArray($form, 'certificado_digital', '0,00');
$contador = getFromArray($form, 'contador', '0,00');
$plano_saude = getFromArray($form, 'plano_saude', '0,00');
$plano_odontologico = getFromArray($form, 'plano_odontologico', '0,00');
$aliquota_simples = getFromArray($form, 'aliquota_simples', '0');

$descontos = getFromArray($form, 'descontosPJ', array());
$beneficios = getFromArray($form, 'beneficiosPJ', array());

$prolabore = getFromArray($pjLiquido, 'prolabore', '0,00');
$prolaboreInss = getFromArray($pjLiquido, 'prolaboreInss', '0,00');
$prolaboreBaseCalculo = getFromArray($pjLiquido, 'prolaboreBaseCalculo', '0,00');
$prolaboreIrpf = getFromArray($pjLiquido, 'prolaboreIrpf', '0,00');
$percentualBruto = getFromArray($pjLiquido, 'percentualBruto', '0');
$prolaboreAliquotaInss = getFromArray($pjLiquido, 'prolaboreAliquotaInss', '0');
$prolaboreAliquotaIrpf = getFromArray($pjLiquido, 'prolaboreAliquotaIrpf', '0');
$prolaboreAliquotaRealIrpf = getFromArray($pjLiquido, 'prolaboreAliquotaRealIrpf', '0');

$descontosTotal = getFromArray($pjLiquido, 'descontosTotal', '0,00');
$beneficiosTotal = getFromArray($pjLiquido, 'beneficiosTotal', '0,00');
$impostoSimples = getFromArray($pjLiquido, 'impostoSimples', '0,00');
$faturamentoLiquidoSemOutrosDescontosEBeneficios = getFromArray($pjLiquido, 'faturamentoLiquidoSemOutrosDescontosEBeneficios', '0,00');
$faturamentoLiquido = getFromArray($pjLiquido, 'faturamentoLiquido', '0,00');
$faturamentoLiquidoAposInssComplementar = getFromArray($pjLiquido, 'faturamentoLiquidoAposInssComplementar', '0,00');
$descontosLiquidoSemOutrosDescontosEBeneficio = getFromArray($pjLiquido, 'descontosLiquidoSemOutrosDescontosEBeneficio', '0,00');
$descontosLiquido = getFromArray($pjLiquido, 'descontosLiquido', '0,00');

$inssFaturamentoLiquido = getFromArray($pjLiquido, 'inssFaturamentoLiquido', '0,00');
$inssComplementarAoProlabore = getFromArray($pjLiquido, 'inssComplementarAoProlabore', '0,00');

$faturamentoLiquidoAntesInssComplementar = getFromArray($pjLiquido, 'faturamentoLiquidoAntesInssComplementar', '0,00');
$descontosLiquidoAntesInssComplementar = getFromArray($pjLiquido, 'descontosLiquidoAntesInssComplementar', '0,00');
$descontosLiquidoAposInssComplementar = getFromArray($pjLiquido, 'descontosLiquidoAposInssComplementar', '0,00');
$faturamentoComBeneficios = getFromArray($pjLiquido, 'faturamentoComBeneficios', '0,00');
$percentualLiquidoAntesInssComplementar = getFromArray($pjLiquido, 'percentualLiquidoAntesInssComplementar', '0');
$percentualLiquidoAposInssComplementar = getFromArray($pjLiquido, 'percentualLiquidoAposInssComplementar', '0');
?>
<div id="resultPj">
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Faturamento<br>Bruto</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $faturamento_bruto ?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Total Descontos<br> Antes Inss Complementar</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $descontosLiquidoAntesInssComplementar ?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-light  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Faturamento Líquido Antes INSS Complementar</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $faturamentoLiquidoAntesInssComplementar ?></h4></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Descontos <br> Inss Complementar</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $inssComplementarAoProlabore ?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Total <br> Descontos</b></div>
                <div class="card-body" style="padding-top: 0.2rem; padding-bottom: 0.4rem;">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                        <h4>R$ <?= $descontosLiquidoAposInssComplementar ?></h4>
                        <?= $percentualLiquidoAposInssComplementar ?> de descontos</td>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-dark text-white mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Faturamento Líquido<br> Final</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $faturamentoLiquidoAposInssComplementar ?></h4></p>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Descrição</th>
                <th scope="col">%</th>
                <th scope="col">Proventos</th>
                <th scope="col">Descontos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Faturamento Bruto</b></td>
                <td></td>
                <td>R$ <?= $faturamento_bruto ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Prolabore</b></td>
                <td><b>R$ <?= $prolabore ?></b> <br><small>(28% do faturamento<br>Para o fator R <br>se enquadrar no Anexo 3)</small></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><b>INSS Prolabore</b></td>
                <td><?= $prolaboreAliquotaInss ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $prolaboreInss ?></td>
            </tr>
            <tr>
                <td><b>IRPF Prolabore</b></td>
                <td><?= $prolaboreAliquotaIrpf ?> (<small><b><?= $prolaboreAliquotaRealIrpf ?></b> de desconto real</small>)</td>
                <td></td>
                <td class="text-danger">R$ <?= $prolaboreIrpf ?></td>
            </tr>
            <tr>
                <td><b>Imposto Simples Nacional</b></td>
                <td><?= $aliquota_simples?>%</td>
                <td></td>
                <td class="text-danger">R$ <?= $impostoSimples ?></td>
            </tr>
            <tr>
                <td><b>Certificado Digital <br> (Valor mensal)</b></td>
                <td></td>
                <td></td>
                <td class="text-danger">R$<?= $certificado_digital?></td>
            </tr>
            <tr>
                <td><b>Contador</td>
                <td></td>
                <td></td>
                <td class="text-danger">R$<?= $contador ?></td>
            </tr>
            <tr>
                <td><b>Plano de Saúde</td>
                <td></td>
                <td></td>
                <td class="text-danger">R$<?= $plano_saude?></td>
            </tr>
            <tr>
                <td><b>Plano Odontológico</td>
                <td></td>
                <td></td>
                <td class="text-danger">R$<?= $plano_odontologico?></td>
            </tr>
            <?php foreach ($beneficios as $beneficio) : ?>
                <?php if ($beneficio['valor'] != 0 && $beneficio['valor'] != "") : ?>
                    <tr>
                        <td><b><?= $beneficio['descricao'] ?></b></td>
                        <td></td>
                        <td class="text-success">R$ <?= $beneficio['valor'] ?></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr class="table-secondary">
                <td><b>Total <br> Outros Benefícios<b></td>
                <td></td>
                <td class="text-success"><b>R$ <?= $beneficiosTotal ?></b></td>
                <td></td>
            </tr>
            <?php foreach ($descontos as $desconto) : ?>
                <?php if ($desconto['valor'] != 0 && $desconto['valor'] != "") : ?>
                    <tr>
                        <td><b><?= $desconto['descricao'] ?></b></td>
                        <td></td>
                        <td></td>
                        <td class="text-danger">R$ <?= $desconto['valor'] ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr class="table-secondary">
                <td><b>Total <br> Outros Descontos<b></td>
                <td></td>
                <td></td>
                <td class="text-danger"><b>R$ <?= $descontosTotal ?></b></td>
            </tr>
            <tr class="table-active">
                <td><b>Total<b></td>
                <td><?= $percentualLiquidoAntesInssComplementar ?> de descontos</td>
                <td><b>R$ <?= $faturamentoComBeneficios ?></b></td>
                <td class="text-danger"><b>R$ <?= $descontosLiquidoAntesInssComplementar ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>Faturamento Líquido <br> Antes INSS Complementar<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $faturamentoLiquidoAntesInssComplementar ?></b></td>
            </tr>
            <tr>
                <td><b>Faturamento Líquido <br> Antes INSS Complementar<b></td>
                <td><b>R$ <?= $faturamentoLiquidoAntesInssComplementar ?></b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><b>INSS Complementar<b></td>
                <td>
                    <small>
                        (Inss Prolabore: <b>R$ <?=$prolaboreInss?></b> + Inss Complementar: <b>R$ <?=$inssComplementarAoProlabore?></b>)
                        <br>=<br>
                        INSS Faturamento Líquido antes INSS complementar: <b>R$ <?=$inssFaturamentoLiquido?></b>
                    </small>
                </td>
                <td></td>
                <td class="text-danger"><b>R$ <?= $inssComplementarAoProlabore ?></b></td>
            </tr>
            <tr class="table-active">
                <td><b>Total<b></td>
                <td><?= $percentualLiquidoAposInssComplementar ?> de descontos</td>
                <td><b>R$ <?= $faturamentoComBeneficios ?></b></td>
                <td class="text-danger"><b>R$ <?= $descontosLiquidoAposInssComplementar ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>Faturamento Líquido <br> Após INSS Complementar</td>
                <td></td>
                <td></td>
                <td><b>R$<?= $faturamentoLiquidoAposInssComplementar?></b></td>
            </tr>
    </table>
</div>