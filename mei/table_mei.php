<?php
$form = getFromArray($meiLiquido, 'form');
$faturamento_bruto = getFromArray($form, 'faturamento_bruto', '0,00');
$das = getFromArray($form, 'das', '0,00');

$descontos = getFromArray($form, 'descontosMEI', array());
$beneficios = getFromArray($form, 'beneficiosMEI', array());

$descontosTotal = getFromArray($meiLiquido, 'descontosTotal', '0,00');
$beneficiosTotal = getFromArray($meiLiquido, 'beneficiosTotal', '0,00');
$faturamentoLiquidoSemOutrosDescontosEBeneficios = getFromArray($meiLiquido, 'faturamentoLiquidoSemOutrosDescontosEBeneficios', '0,00');
$faturamentoLiquido = getFromArray($meiLiquido, 'faturamentoLiquido', '0,00');
$faturamentoLiquidoAposInssComplementar = getFromArray($meiLiquido, 'faturamentoLiquidoAposInssComplementar', '0,00');
$descontosLiquidoSemOutrosDescontosEBeneficio = getFromArray($meiLiquido, 'descontosLiquidoSemOutrosDescontosEBeneficio', '0,00');
$descontosLiquido = getFromArray($meiLiquido, 'descontosLiquido', '0,00');

$inssFaturamentoLiquido = getFromArray($meiLiquido, 'inssFaturamentoLiquido', '0,00');
$inssComplementarAoProlabore = getFromArray($meiLiquido, 'inssComplementarAoProlabore', '0,00');

$faturamentoLiquidoAntesInssComplementar = getFromArray($meiLiquido, 'faturamentoLiquidoAntesInssComplementar', '0,00');
$descontosLiquidoAntesInssComplementar = getFromArray($meiLiquido, 'descontosLiquidoAntesInssComplementar', '0,00');
$descontosLiquidoAposInssComplementar = getFromArray($meiLiquido, 'descontosLiquidoAposInssComplementar', '0,00');
$faturamentoComBeneficios = getFromArray($meiLiquido, 'faturamentoComBeneficios', '0,00');
$percentualLiquidoAntesInssComplementar = getFromArray($meiLiquido, 'percentualLiquidoAntesInssComplementar', '0%');
$percentualLiquidoAposInssComplementar = getFromArray($meiLiquido, 'percentualLiquidoAposInssComplementar', '0%');
?>
<div id="resultMei">
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header">
                    <?php if(moneyToNumber($faturamento_bruto) > 6750): ?>
                        <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true" data-toggle="tooltip"
                        data-html="true" data-placement="right" 
                        title="Faturamento Bruto maior que o média mensal máxima. <br>
                        MEI max anual: <br>R$ 81.000,00 <br> MEI max média mensal: <br><b>R$ 6.750,00</b>"></i>
                    <?php endif; ?>
                    <br>
                    <b>Faturamento Bruto</b>
                </div>
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
                <td><b>DAS MEI</b></td>
                <td><?= $das ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $das ?></td>
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
                        (Inss MEI: <b>R$ <?=$das?></b> + Inss Complementar: <b>R$ <?=$inssComplementarAoProlabore?></b>)
                        <br>=<br>
                        INSS do Faturamento Líquido antes INSS complementar: <b>R$ <?=$inssFaturamentoLiquido?></b>
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