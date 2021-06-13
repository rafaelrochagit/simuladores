<?php
$form = getFromArray($jcResult, 'form');
$valor_inicial = getFromArray($form, 'valor_inicial', '0,00');
$aporte = getFromArray($form, 'aporte', '0,00');
$porcentagem = getFromArray($form, 'porcentagem', '0');
$corretagem = getFromArray($form, 'corretagem', '0');
$retirada = getFromArray($form, 'retirada', '0');
$periodo = getFromArray($form, 'periodo', '0');

$valorFinal = getFromArray($jcResult, 'valorFinal', '0,00');
$valorFinalBase = getFromArray($jcResult, 'valorFinalBase', '0,00');
$valorFinalTotal = getFromArray($jcResult, 'valorFinalTotal', '0,00');
$aporteTotal = getFromArray($jcResult, 'aporteTotal', '0,00');
$inicialMaisAporte = getFromArray($jcResult, 'inicialMaisAporte', '0,00');
$ganhoTotal = getFromArray($jcResult, 'ganhoTotal', '0,00');

$totalCorretagem = getFromArray($jcResult, 'totalCorretagem', '0,00');
$totalRetirada = getFromArray($jcResult, 'totalRetirada', '0,00');

$taxaJurosTotal = getFromArray($jcResult, 'taxaJurosTotal', '0');
$taxaCorretagemTotal = getFromArray($jcResult, 'taxaCorretagemTotal', '0');
$taxaRetiradaTotal = getFromArray($jcResult, 'taxaRetiradaTotal', '0');

$detalhe = getFromArray($jcResult, 'detalhe', array());

?>
<div id="resultJc">
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header">
                    <b>Valor Inicial</b>
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4>R$ <?= $valor_inicial ?></h4>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Taxa</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $porcentagem ?> %</h4>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-light  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Período</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $periodo ?></h4>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card bg-light  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Corretagem</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $corretagem ?> %</h4>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-light  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Retirada</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $retirada ?> %</h4>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Valor Final</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4>R$ <?= $valorFinal ?></h4>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Período</th>
            <th scope="col">Base</th>
            <th scope="col">Aporte</th>
            <th scope="col">Base + Aporte</th>
            <th scope="col">Taxa(%)</th>
            <th scope="col">Ganho</th>
            <th scope="col">Corretagem(%)</th>
            <th scope="col">Corretagem</th>
            <th scope="col">Retirada(%)</th>
            <th scope="col">Retirada</th>
            <th scope="col">Valor Líquido</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detalhe as $d) : ?>
            <tr>
                <td><?=$d['periodo']?></td>
                <td>R$ <?=$d['valorBaseAntesAporte']?></td>
                <td>R$ <?=$d['aporte']?></td>
                <td>R$ <?=$d['valorBase']?></td>
                <td><?=$porcentagem+100?> %</td>
                <td>R$ <?=$d['valorNovo']?></td>
                <td><?=$corretagem?> %</td>
                <td>R$ <?=$d['corretagem']?></td>
                <td><?=$retirada?> %</td>
                <td>R$ <?=$d['retirada']?></td>
                <td>R$ <?=$d['valorFinal']?></td>
            </tr>
        <?php endforeach; ?>
        <tr class="table-warning">
            <td>TOTAIS</td>
            <td>Valor Inicial</td>
            <td>Total Aportes</td>
            <td>Inicial + Aportes</td>
            <td>Juros</td>
            <td>Ganho Total</td>
            <td>Tx Corretagem</td>
            <td>Corretagem</td>
            <td>Tx Retirada</td>
            <td>Retirada</td>
            <td>Final</td>
        </tr>
        <tr class="table-black">
            <td>-</td>
            <td>R$ <?= $valor_inicial?></td>
            <td>R$ <?= $aporteTotal?></td>
            <td>R$ <?= $inicialMaisAporte ?></td>
            <td><?= $taxaJurosTotal ?> %</td>
            <td>R$ <?=$ganhoTotal?></td>
            <td><?= $taxaCorretagemTotal ?> %</td>
            <td>R$ <?= $totalCorretagem?></td>
            <td><?= $taxaRetiradaTotal ?> %</td>
            <td>R$ <?= $totalRetirada?></td>
            <td>R$ <?= $valorFinal?></td>
        </tr>
</table>