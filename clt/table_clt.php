<?php
$form = getFromArray($cltLiquido, 'form');
$salario_bruto = getFromArray($form, 'salario_bruto', '0,00');
$numero_dependentes = getFromArray($form, 'numero_dependentes', '0');
$valor_pensao = getFromArray($form, 'valor_pensao', '0,00');
$auxilio_alimentacao = getFromArray($form, 'auxilio_alimentacao', '0,00');
$auxilio_refeicao = getFromArray($form, 'auxilio_refeicao', '0,00');
$auxilio_transporte = getFromArray($form, 'auxilio_transporte', '0,00');
$desconto_alimentacao = getFromArray($form, 'desconto_alimentacao', '0,00');
$desconto_refeicao = getFromArray($form, 'desconto_refeicao', '0,00');

$sindicato_check = getFromArray($form, 'sindicato_check', false);
$valorSindicatoAnual = getFromArray($cltLiquido, 'valorSindicatoAnual', '0,00');
$valorSindicatoMensal = getFromArray($cltLiquido, 'valorSindicatoMensal', '0,00');

$plr = getFromArray($form, 'plr', '0,00');
$plrMes = getFromArray($cltLiquido, 'plrMes', '0,00');
$irpfPlr = getFromArray($cltLiquido, 'irpfPlr', '0,00');
$irpfPlrMes = getFromArray($cltLiquido, 'irpfPlrMes', '0,00');
$irpfPlrMes = getFromArray($cltLiquido, 'irpfPlrMes', '0,00');
$plrLiquido = getFromArray($cltLiquido, 'plrLiquido', '0,00');
$plrMensalLiquido = getFromArray($cltLiquido, 'plrMensalLiquido', '0,00');
$aliquotaIrpfPlr = getFromArray($cltLiquido, 'aliquotaIrpfPlr', '0%');

$descontoTransporte = getFromArray($cltLiquido, 'descontoTransporte', '0,00');
$descontoTransportePercent = getFromArray($cltLiquido, 'descontoTransportePercent', '0%');
$descontos = getFromArray($form, 'descontosCLT', array());
$beneficios = getFromArray($form, 'beneficiosCLT', array());

$percentualAlimentacao = getFromArray($cltLiquido, 'percentualAlimentacao', '0');
$percentualRefeicao = getFromArray($cltLiquido, 'percentualRefeicao', '0');
$inssValor = getFromArray($cltLiquido, 'inssValor', '0,00');
$irpfValor = getFromArray($cltLiquido, 'irpfValor', '0,00');
$salarioLiquido = getFromArray($cltLiquido, 'salarioLiquido', '0,00');
$descontosLiquido = getFromArray($cltLiquido, 'descontosLiquido', '0,00');
$percentualBruto = getFromArray($cltLiquido, 'percentualBruto', '-');
$aliquotaInss = getFromArray($cltLiquido, 'aliquotaInss', '0');
$aliquotaIrpf = getFromArray($cltLiquido, 'aliquotaIrpf', '0');
$descontosTotal = getFromArray($cltLiquido, 'descontosTotal', '0,00');
$beneficiosTotal = getFromArray($cltLiquido, 'beneficiosTotal', '0,00');
$salarioLiquidoAposDescontosEbeneficios = getFromArray($cltLiquido, 'salarioLiquidoAposDescontosEbeneficios', '0,00');
$decimoTerceiroLiquidoMes = getFromArray($cltLiquido, 'decimoTerceiroLiquidoMes', '0,00');
$aliquotaRealIrpf = getFromArray($cltLiquido, 'aliquotaRealIrpf', '-');

$tercoFeriasBruto = getFromArray($cltLiquido, 'tercoFeriasBruto', '0,00');
$tercoFeriasInss = getFromArray($cltLiquido, 'tercoFeriasInss', '0,00');
$tercoFeriasIrpf = getFromArray($cltLiquido, 'tercoFeriasIrpf', '0,00');
$tercoFeriasLiquido = getFromArray($cltLiquido, 'tercoFeriasLiquido', '0,00');
$tercoFeriasDescontosLiquido = getFromArray($cltLiquido, 'tercoFeriasDescontosLiquido', '0,00');
$tercoFeriasPercentualBruto = getFromArray($cltLiquido, 'tercoFeriasPercentualBruto', '-');
$tercoFeriasAliquotaInss = getFromArray($cltLiquido, 'tercoFeriasAliquotaInss', '0');
$tercoFeriasAliquotaIrpf = getFromArray($cltLiquido, 'tercoFeriasAliquotaIrpf', '0');
$tercoFeriasMensalLiquido = getFromArray($cltLiquido, 'tercoFeriasMensalLiquido', '0,00');
$tercoFeriasAliquotaRealIrpf = getFromArray($cltLiquido, 'tercoFeriasAliquotaRealIrpf', '-');

$fgts = getFromArray($cltLiquido, 'fgts', '0,00');
$decimoTerceiroFgts = getFromArray($cltLiquido, 'decimoTerceiroFgts', '0,00');
$fgtsAnual = getFromArray($cltLiquido, 'fgtsAnual', '0,00');
$tercoFeriasFgts = getFromArray($cltLiquido, 'tercoFeriasFgts', '0,00');
$fgtsTotalAno = getFromArray($cltLiquido, 'fgtsTotalAno', '0,00');
$fgtsTotalAnoMes = getFromArray($cltLiquido, 'fgtsTotalAnoMes', '0,00');

$salarioLiquidoFinal = getFromArray($cltLiquido, 'salarioLiquidoFinal', '0,00');
$salarioLiquidoSemFgts = getFromArray($cltLiquido, 'salarioLiquidoSemFgts', '0,00');

$beneficiosCLTMediaMes = moneyToNumber($fgtsTotalAnoMes) + moneyToNumber($tercoFeriasMensalLiquido) + moneyToNumber($tercoFeriasMensalLiquido); 
$beneficiosCLTMediaMes = numberToMoney($beneficiosCLTMediaMes);
?>
<div id="resultClt">
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header">
                    <?php if(moneyToNumber($salario_bruto) >0 && moneyToNumber($salario_bruto) < 1100): ?>
                    <i class="fa fa-exclamation-triangle text-danger" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="right" 
                        title="Sal??rio menor que o <b>sal??rio m??nimo</b>: R$ 1.100,00"></i>
                    <?php endif; ?>
                    <br>
                    <b>Sal??rio Bruto</b>
                  
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $salario_bruto ?></h4></p>
                       
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Total Descontos<br> CLT</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $descontosLiquido ?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-light  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Sal??rio L??quido<br>Mensal</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $salarioLiquido ?></h4></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Sal??rio L??quido ap??s outros Benef??cios e Descontos</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $salarioLiquidoAposDescontosEbeneficios ?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-success text-white  mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Benef??cios CLT anuais <br>M??dia Mensal</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $beneficiosCLTMediaMes?></h4></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-dark text-white mb-3 text-center" style="max-width: 18rem;">
                <div class="card-header"><b>Sal??rio L??quido com Benef??cios Anuais (M??dia Mensal)</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><h4>R$ <?= $salarioLiquidoFinal ?></h4></p>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Descri????o</th>
                <th scope="col">%</th>
                <th scope="col">Proventos</th>
                <th scope="col">Descontos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Sal??rio Bruto</b></td>
                <td></td>
                <td>R$ <?= $salario_bruto ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>INSS</b></td>
                <td><?= $aliquotaInss ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $inssValor ?></td>
            </tr>
            <tr>
                <td><b>IRPF</b></td>
                <td><?= $aliquotaIrpf ?> (<small><b><?= $aliquotaRealIrpf ?></b> de desconto real</small>)</td>
                <td></td>
                <td class="text-danger">R$ <?= $irpfValor ?></td>
            </tr>
            <tr>
                <td><b>Pens??o Aliment??cia</b></td>
                <td></td>
                <td></td>
                <td class="text-danger">R$ <?= $valor_pensao ?></td>
            </tr>
            <tr class="table-active">
                <td><b>Total<b></td>
                <td><?= $percentualBruto ?> de descontos</td>
                <td><b>R$ <?= $salario_bruto ?></b></td>
                <td class="text-danger"><b>R$ <?= $descontosLiquido ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>Sal??rio L??quido<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $salarioLiquido ?></b></td>
            </tr>
            <tr class="table-success">
                <td colspan="4" class="text-center"><b>Benef??cios<b></td>
            </tr>
            <?php if ($auxilio_transporte != 0 && $auxilio_transporte != "") : ?>
                <tr>
                    <td><b>Aux??lio Transporte</b></td>
                    <td></td>
                    <td class="text-success">R$ <?= $auxilio_transporte ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
            <?php if ($auxilio_alimentacao != 0 && $auxilio_alimentacao != "") : ?>
                <tr>
                    <td><b>Aux??lio Alimenta????o</b></td>
                    <td></td>
                    <td class="text-success">R$ <?= $auxilio_alimentacao ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
            <?php if ($auxilio_refeicao != 0 && $auxilio_refeicao != "") : ?>
                <tr>
                    <td><b>Aux??lio Refei????o</b></td>
                    <td></td>
                    <td class="text-success">R$ <?= $auxilio_refeicao ?></td>
                    <td></td>
                </tr>
            <?php endif; ?>
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
                <td><b>Total <br> Outros Benef??cios<b></td>
                <td></td>
                <td class="text-success"><b>R$ <?= $beneficiosTotal ?></b></td>
                <td></td>
            </tr>
            <tr class="table-black">
                <td colspan="4"></td>
            </tr>
            <tr class="table-danger">
                <td colspan="4" class="text-center"><b>Descontos<b></td>
            </tr>
            <?php if ($descontoTransporte != 0 && $descontoTransporte != "") : ?>
                <tr>
                    <td><b>Aux??lio Transporte</b></td>
                    <td><?= $descontoTransportePercent ?></td>
                    <td></td>
                    <td class="text-danger">R$ <?= $descontoTransporte ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($desconto_alimentacao != 0 && $desconto_alimentacao != "") : ?>
                <tr>
                    <td><b>Desconto Alimenta????o</b></td>
                    <td><?= $percentualAlimentacao ?></td>
                    <td></td>
                    <td class="text-danger">R$ <?= $desconto_alimentacao ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($desconto_refeicao != 0 && $desconto_refeicao != "") : ?>
                <tr>
                    <td><b>Desconto Refei????o</b></td>
                    <td><?= $percentualRefeicao ?></td>
                    <td></td>
                    <td class="text-danger">R$ <?= $desconto_refeicao ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($sindicato_check) : ?>
                <tr>
                    <td><b>Desconto Sindicato</b></td>
                    <td>R$ <?= $valorSindicatoAnual ?> anual</td>
                    <td></td>
                    <td class="text-danger">R$ <?= $valorSindicatoMensal ?> (m??dia mensal)</td>
                </tr>
            <?php endif; ?>
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
            <tr class="table-black">
                <td colspan="4"></td>
            </tr>
            <tr>
                <td><b>Sal??rio L??quido</b></td>
                <td></td>
                <td>R$ <?= $salarioLiquido ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Total Benef??cios</b></td>
                <td></td>
                <td class="text-success">R$ <?= $beneficiosTotal ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Total Descontos</b></td>
                <td></td>
                <td></td>
                <td class="text-danger">R$ <?= $descontosTotal ?></td>
            </tr>
            <tr class="table-black">
                <td><b>Sal??rio L??quido ap??s <br> Outros Benef??cios e <br> Outros Descontos<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $salarioLiquidoAposDescontosEbeneficios ?></b></td>
            </tr>
    </table>
    <table class="table">
        <thead class="thead-success">
            <tr class="table-success" data-toggle="collapse" data-target="#decimoTerceiroBody">
                <th colspan="4" class="text-center link"><b>13?? Sal??rio<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="decimoTerceiroBody" class="collapse">
            <tr>
                <td><b>Bruto</b></td>
                <td></td>
                <td>R$ <?= $salario_bruto ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>INSS</b></td>
                <td><?= $aliquotaInss ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $inssValor ?></td>
            </tr>
            <tr>
                <td><b>IRPF</b></td>
                <td><?= $aliquotaIrpf ?> (<small><b><?= $aliquotaRealIrpf ?></b> de desconto real</small>)</td>
                <td></td>
                <td class="text-danger">R$ <?= $irpfValor ?></td>
            </tr>
            <tr>
                <td><b>Pens??o Aliment??cia</b></td>
                <td></td>
                <td></td>
                <td class="text-danger">R$ <?= $valor_pensao ?></td>
            </tr>
            <tr class="table-active">
                <td><b>Total<b></td>
                <td><?= $percentualBruto ?> de descontos</td>
                <td><b>R$ <?= $salario_bruto ?></b></td>
                <td class="text-danger"><b>R$ <?= $descontosLiquido ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>L??quido<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $salarioLiquido ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>M??dia Mensal <br> L??quida<b></td>
                <td>1/12</td>
                <td></td>
                <td><b>R$ <?= $decimoTerceiroLiquidoMes ?></b></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-success">
            <tr class="table-success" data-toggle="collapse" data-target="#feriasBody">
                <th colspan="4" class="text-center link"><b>F??rias<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="feriasBody" class="collapse">
            <tr>
                <td><b>F??rias Bruto</b></td>
                <td></td>
                <td>R$ <?= $tercoFeriasBruto ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>F??rias INSS</b></td>
                <td><?= $tercoFeriasAliquotaInss ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $tercoFeriasInss ?></td>
            </tr>
            <tr>
                <td><b>F??rias IRPF</b></td>
                <td><?= $tercoFeriasAliquotaIrpf ?> (<small><b><?= $tercoFeriasAliquotaRealIrpf ?></b> de desconto real</small>)</td>
                <td></td>
                <td class="text-danger">R$ <?= $tercoFeriasIrpf ?></td>
            </tr>
            <tr>
                <td><b>Pens??o Aliment??cia</b></td>
                <td></td>
                <td></td>
                <td class="text-danger">R$ <?= $valor_pensao ?></td>
            </tr>
            <tr class="table-active">
                <td><b>Total<b></td>
                <td><?= $tercoFeriasPercentualBruto ?> de descontos</td>
                <td><b>R$ <?= $tercoFeriasBruto ?></b></td>
                <td class="text-danger"><b>R$ <?= $tercoFeriasDescontosLiquido ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>F??rias L??quido<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $tercoFeriasLiquido ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>F??rias <br>M??dia Mensal <br>L??quida<b></td>
                <td>1/12</td>
                <td></td>
                <td><b>R$ <?= $tercoFeriasMensalLiquido ?></b></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-warning">
            <tr class="table-warning" data-toggle="collapse" data-target="#anoMensalSemFgtsBody">
                <th colspan="4" class="text-center link"><b>(SEM FGTS) <br> Sal??rio L??quido Mensal<br> M??dia com base nos ganhos anuais<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="anoMensalSemFgtsBody">
            <tr>
                <td><b>Sal??rio L??quido ap??s Outros Benef??cios e Outros Descontos<b></td>
                <td></td>
                <td></td>
                <td class="text-success">R$ <?= $salarioLiquidoAposDescontosEbeneficios ?></td>
            </tr>
            <tr>
                <td><b>13?? M??dia Mensal L??quida<b></td>
                <td></td>
                <td></td>
                <td class="text-success">R$ <?= $decimoTerceiroLiquidoMes ?></td>
            </tr>
            <tr>
                <td><b>F??rias M??dia Mensal L??quida<b></td>
                <td></td>
                <td></td>
                <td class="text-success">R$ <?= $tercoFeriasMensalLiquido ?></td>
            </tr>
            <tr class="table-black">
                <td><b>Sal??rio L??quido M??dio com Benef??cios Anuais (SEM FGTS)</td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $salarioLiquidoSemFgts ?></b></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-success">
            <tr class="table-success" data-toggle="collapse" data-target="#fgtsBody">
                <th colspan="4" class="text-center link"><b>FGTS<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="fgtsBody" class="collapse">
            <tr>
                <td style="width:70%"><b>FGTS do Sal??rio</b></td>
                <td></td>
                <td></td>
                <td>R$ <?= $fgts ?></td>
            </tr>
            <tr>
                <td><b>FGTS do Sal??rio (Total Ano)</b></td>
                <td>12x</td>
                <td></td>
                <td class="text-success">R$ <?= $fgtsAnual ?></td>
            </tr>
            <tr>
                <td><b>FGTS do 13??</b></td>
                <td></td>
                <td></td>
                <td class="text-success">R$ <?= $decimoTerceiroFgts ?></td>
            </tr>
            <tr>
                <td><b>FGTS do 1/3 das F??rias</b></td>
                <td></td>
                <td></td>
                <td class="text-success">R$ <?= $tercoFeriasFgts ?></td>
            </tr>
            <tr class="table-black">
                <td><b>FGTS Total Ano<b></td>
                <td></td>
                <td></td>
                <td><b>R$ <?= $fgtsTotalAno ?></b></td>
            </tr>
            <tr class="table-black">
                <td><b>FGTS Total Ano M??dia Mensal<b></td>
                <td>1/12</td>
                <td></td>
                <td><b>R$ <?= $fgtsTotalAnoMes ?></b></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-success">
            <tr class="table-success" data-toggle="collapse" data-target="#irpfPlrBody">
                <th colspan="4" class="text-center link"><b>PLR<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="irpfPlrBody" class="collapse">
            <tr>
                <td style="width:70%"><b>PLR</b></td>
                <td></td>
                <td></td>
                <td>R$ <?= $plr ?></td>
            </tr>
            <tr>
                <td><b>IRPF</b></td>
                <td><?= $aliquotaIrpfPlr ?></td>
                <td></td>
                <td class="text-danger">R$ <?= $irpfPlr ?></td>
            </tr>
            <tr>
                <td><b>PLR do Sal??rio M??dia Mensal</b></td>
                <td></td>
                <td></td>
                <td>R$ <?= $plrMes ?></td>
            </tr>
            <tr>
                <td><b>IRPF PLR Total Ano M??dia Mensal<b></td>
                <td>1/12</td>
                <td></td>
                <td class="text-danger">R$ <?= $irpfPlrMes ?></td>
            </tr>
            <tr class="table-black">
                <td><b>PLR L??quida</b></td>
                <td></td>
                <td></td>
                <td>R$ <?= $plrLiquido ?></td>
            </tr>
            <tr class="table-black">
                <td><b>PLR Mensal L??quida</b></td>
                <td></td>
                <td></td>
                <td>R$ <?= $plrMensalLiquido ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead class="thead-dark">
            <tr class="table-success" data-toggle="collapse" data-target="#anoMensalBody">
                <th colspan="4" class="text-center link"><b>Sal??rio L??quido Mensal<br> M??dia com base nos ganhos anuais<b> <i class="fa fa-angle-down rotate-icon"></i></th>
            </tr>
        </thead>
        <tbody id="anoMensalBody">
            <tr>
                <td style="width:80%"><b>Sal??rio L??quido ap??s Outros Benef??cios e Outros Descontos<b></td>
                <td></td>
                <td class="text-success">R$ <?= $salarioLiquidoAposDescontosEbeneficios ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>13?? M??dia Mensal L??quida<b></td>
                <td></td>
                <td class="text-success">R$ <?= $decimoTerceiroLiquidoMes ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>F??rias M??dia Mensal L??quida<b></td>
                <td></td>
                <td class="text-success">R$ <?= $tercoFeriasMensalLiquido ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>FGTS Anual M??dia Mensal<b></td>
                <td></td>
                <td class="text-success">R$ <?= $fgtsTotalAnoMes ?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>PLR Mensal L??quida<b></td>
                <td></td>
                <td class="text-success">R$ <?= $plrMensalLiquido ?></td>
                <td></td>
            </tr>
            <tr class="table-black">
                <td><b>Sal??rio L??quido M??dio com Benef??cios Anuais</td>
                <td></td>
                <td><b>R$ <?= $salarioLiquidoFinal ?></b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>