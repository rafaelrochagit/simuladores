<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";
require_once __DIR__ . "/../irpf_plr/IRPF_PLR.php";

class CLT
{

    private $filepath = __DIR__ . "/";

    private $inss;

    private $irpf;

    private $irpfPlr;

    function __construct()
    {
        $this->inss = new INSS();
        $this->irpf = new IRPF();
        $this->irpfPlr = new IRPF_PLR();
    }

    function salarioLiquido($salarioBruto, $valorPensao, $inssValor, $irpfValor)
    {
        if (strpos($salarioBruto, ',')) $salarioBruto = moneyToNumber($salarioBruto);
        if (strpos($valorPensao, ',')) $valorPensao = moneyToNumber($valorPensao);
        if (strpos($inssValor, ',')) $inssValor = moneyToNumber($inssValor);
        if (strpos($irpfValor, ',')) $irpfValor = moneyToNumber($irpfValor);
        return $salarioBruto - $valorPensao - $inssValor - $irpfValor;
    }

    function beneficios($beneficios, $outrosBeneficios = array())
    {
        if ($beneficios == null) $beneficios = array();
        $total = 0;
        foreach ($beneficios as $b) {
            if ($b != "") $total += moneyToNumber($b['valor']);
        }
        foreach ($outrosBeneficios as $d) {
            if (strpos($d, ',')) $d = moneyToNumber($d);
            $total += $d;
        }
        return $total;
    }

    function descontos($descontos, $outrosDescontos = array())
    {
        if ($descontos == null) $descontos = array();
        $total = 0;
        foreach ($descontos as $d) {
            if ($d != "") $total += moneyToNumber($d['valor']);
        }
        foreach ($outrosDescontos as $d) {
            if (strpos($d, ',')) $d = moneyToNumber($d);
            $total += $d;
        }
        return $total;
    }

    function salvarCodSimulacao($cod)
    {
        file_put_contents($this->filepath . "/simulacao/codAtual.json", $cod);
    }

    function readCodSimulacao()
    {
        $cod = @file_get_contents($this->filepath . "/simulacao/codAtual.json");
        return $cod;
    }

    function salvarSimulacoes($simulacoes)
    {
        $simulacaoJson = json_encode($simulacoes);
        file_put_contents($this->filepath . "/simulacao/simulacoes.json", $simulacaoJson);
    }

    function readSimulacoes()
    {
        $simulacaoJson = @file_get_contents($this->filepath . "/simulacao/simulacoes.json");
        $simulacoes = array();
        if ($simulacaoJson) {
            $simulacoes = json_decode($simulacaoJson, true);
        }
        return $simulacoes;
    }

    function salarioLiquidoFinal(
        $salarioBruto,
        $numeroDependentes,
        $valorPensao,
        $descontos,
        $descontoAlimentacao,
        $descontoRefeicao,
        $beneficios,
        $auxilioAlimentacao,
        $auxilioRefeicao,
        $descontoTransporte,
        $auxilioTransporte,
        $plr, 
        $sindicato
    ) {
        if (strpos($salarioBruto, ',')) $salarioBruto = moneyToNumber($salarioBruto);
        if (strpos($valorPensao, ',')) $valorPensao = moneyToNumber($valorPensao);
        if (strpos($descontoAlimentacao, ',')) $descontoAlimentacao = moneyToNumber($descontoAlimentacao);
        if (strpos($descontoRefeicao, ',')) $descontoRefeicao = moneyToNumber($descontoRefeicao);
        if (strpos($auxilioAlimentacao, ',')) $auxilioAlimentacao = moneyToNumber($auxilioAlimentacao);
        if (strpos($auxilioRefeicao, ',')) $auxilioRefeicao = moneyToNumber($auxilioRefeicao);
        if (strpos($plr, ',')) $plr = moneyToNumber($plr);

        $inssValor = $this->inss->calcular($salarioBruto);
        $irpfValor = $this->irpf->calcular($salarioBruto, $numeroDependentes, $valorPensao);
        $tercoFeriasBruto = $salarioBruto / 3;
        $tercoFeriasInss = $this->inss->calcular($tercoFeriasBruto);
        $tercoFeriasIrpf = $this->irpf->calcular($tercoFeriasBruto, $numeroDependentes, $valorPensao);
        $tercoFeriasLiquido = $this->salarioLiquido($tercoFeriasBruto, $valorPensao, $tercoFeriasInss, $tercoFeriasIrpf);
        $tercoFeriasMensalLiquido = $tercoFeriasLiquido / 12;
        $fgts = $salarioBruto * 0.08;
        $decimoTerceiroFgts = $fgts;
        $fgtsAnual = $fgts * 12;
        $tercoFeriasFgts = $tercoFeriasBruto * 0.08;
        $fgtsTotalAno = $fgtsAnual + $decimoTerceiroFgts + $tercoFeriasFgts;
        $fgtsTotalAnoMes = $fgtsTotalAno / 12;

        $plrMes = $plr/12;
        $irpfPlrValor = $this->irpfPlr->calcular($plr);
        $irpfPlrMes = $irpfPlrValor/12;

        $salarioLiquido = $this->salarioLiquido($salarioBruto, $valorPensao, $inssValor, $irpfValor);
        $decimoTerceiroLiquidoMes = $salarioLiquido / 12;

        $descontosTotal = $this->descontos($descontos, [$descontoAlimentacao, $descontoRefeicao, $descontoTransporte]);
        $beneficiosTotal = $this->beneficios($beneficios,  [$auxilioAlimentacao, $auxilioRefeicao, $auxilioTransporte]);
        $descontosTotal = $descontosTotal + $sindicato;

        $salarioLiquidoAposDescontosEbeneficios = $salarioLiquido + $beneficiosTotal - $descontosTotal;
        $salarioLiquidoSemFgts = $salarioLiquidoAposDescontosEbeneficios + $decimoTerceiroLiquidoMes + $tercoFeriasMensalLiquido;
        $salarioLiquidoFinal =  $salarioLiquidoSemFgts + $fgtsTotalAnoMes + $plrMes - $irpfPlrMes;

        return $salarioLiquidoFinal;
    }

    function formSimulacao($form)
    {
        $cltArray['form'] = $form;

        $codSimulacaoClt = isset($form['codSimulacaoClt']) ? $form['codSimulacaoClt'] : '';

        $salarioBruto = $form['salario_bruto'];
        $numeroDependentes = $form['numero_dependentes'];
        $valorPensao = $form['valor_pensao'];
        $plr = $form['plr'];

        $descontos = getFromArray($form, 'descontosCLT', array());
        $beneficios = getFromArray($form, 'beneficiosCLT', array());

        $auxilioAlimentacao = moneyToNumber($form['auxilio_alimentacao']);
        $descontoAlimentacao = moneyToNumber($form['desconto_alimentacao']);
        $auxilioRefeicao = moneyToNumber($form['auxilio_refeicao']);
        $descontoRefeicao = moneyToNumber($form['desconto_refeicao']);

        $salarioBruto = moneyToNumber($salarioBruto);
        $plrValor = moneyToNumber($plr);
        $baseCalculoIrpf = $this->irpf->baseCalculo($salarioBruto, $numeroDependentes, $valorPensao);
        $inssValor = $this->inss->calcular($salarioBruto);
        $irpfValor = $this->irpf->calcular($salarioBruto, $numeroDependentes, $valorPensao);

        $descontoTransportePercent = '6%';
        $descontoTransporte = 0;
        if(isset($form['auxilio_transporte_check']) && $form['auxilio_transporte_check']) {
            $descontoTransporte = $salarioBruto*0.06;
        }
        $auxilioTransporte = moneyToNumber($form['auxilio_transporte']);

        $valorSindicatoAnual = 0;
        if(isset($form['sindicato_check']) && $form['sindicato_check']) {
            $valorSindicatoAnual = $salarioBruto/30;
        }

        $valorSindicatoMensal = $valorSindicatoAnual/12;

        $tercoFeriasBruto = $salarioBruto / 3;
        $tercoFeriasInss = $this->inss->calcular($tercoFeriasBruto);
        $tercoFeriasBaseCalculo = $this->irpf->baseCalculo($tercoFeriasBruto, $numeroDependentes, $valorPensao);
        $tercoFeriasIrpf = $this->irpf->calcular($tercoFeriasBruto, $numeroDependentes, $valorPensao);
        $tercoFeriasLiquido = $this->salarioLiquido($tercoFeriasBruto, $valorPensao, $tercoFeriasInss, $tercoFeriasIrpf);
        $tercoFeriasDescontosLiquido = $tercoFeriasBruto - $tercoFeriasLiquido;
        $tercoFeriasMensalLiquido = $tercoFeriasLiquido / 12;

        $fgts = $salarioBruto * 0.08;
        $decimoTerceiroFgts = $fgts;
        $fgtsAnual = $fgts * 12;
        $tercoFeriasFgts = $tercoFeriasBruto * 0.08;
        $fgtsTotalAno = $fgtsAnual + $decimoTerceiroFgts + $tercoFeriasFgts;
        $fgtsTotalAnoMes = $fgtsTotalAno / 12;

        $salarioLiquido = $this->salarioLiquido($salarioBruto, $valorPensao, $inssValor, $irpfValor);
        
        $descontosLiquido = $salarioBruto - $salarioLiquido;
        $decimoTerceiroLiquidoMes = $salarioLiquido / 12;
        
        $aliquotaRealIrpf = $irpfValor / $salarioBruto;

        $tercoFeriasAliquotaRealIrpf = $tercoFeriasIrpf / $tercoFeriasBruto;

        $descontosTotal = $this->descontos($descontos, [$descontoAlimentacao, $descontoRefeicao, $descontoTransporte]);
        $beneficiosTotal = $this->beneficios($beneficios,  [$auxilioAlimentacao, $auxilioRefeicao, $auxilioTransporte]);
        $descontosTotal = $descontosTotal + $valorSindicatoMensal;

        $salarioLiquidoAposDescontosEbeneficios = $salarioLiquido + $beneficiosTotal - $descontosTotal;

        $salarioLiquidoSemFgts = $salarioLiquidoAposDescontosEbeneficios + $decimoTerceiroLiquidoMes + $tercoFeriasMensalLiquido;
        $salarioLiquidoFinal = $salarioLiquidoAposDescontosEbeneficios + $decimoTerceiroLiquidoMes + $tercoFeriasMensalLiquido + $fgtsTotalAnoMes;

        $plrMes = $plrValor/12;
        $irpfPlrValor = $this->irpfPlr->calcular($plrValor);

        $irpfPlrMes = $irpfPlrValor/12;

        $plrLiquido = $plrValor - $irpfPlrValor;
        $plrMensalLiquido = $plrMes - $irpfPlrMes;

        $salarioLiquidoFinal = $salarioLiquidoFinal + $plrMes - $irpfPlrMes;

        $cltArray['valorSindicatoAnual'] = numberToMoney($valorSindicatoAnual);
        $cltArray['valorSindicatoMensal'] = numberToMoney($valorSindicatoMensal);

        $cltArray['irpfPlr'] = numberToMoney($irpfPlrValor);
        $cltArray['irpfPlrMes'] = numberToMoney($irpfPlrMes);
        $cltArray['aliquotaIrpfPlr'] = numberToPercent($this->irpfPlr->aliquota($plrValor) * 100) . "%";
        $cltArray['plrLiquido'] = numberToMoney($plrLiquido);
        $cltArray['plrMensalLiquido'] = numberToMoney($plrMensalLiquido);

        $cltArray['inssValor'] = numberToMoney($inssValor);
        $cltArray['irpfValor'] = numberToMoney($irpfValor);
        $cltArray['salarioLiquido'] = numberToMoney($salarioLiquido);
        $cltArray['descontosLiquido'] = numberToMoney($descontosLiquido);
        $cltArray['percentualBruto'] = numberToPercent(($descontosLiquido / $salarioBruto) * 100) . "%";
        $cltArray['aliquotaInss'] = $this->inss->aliquotaInssPercent($salarioBruto);
        $cltArray['aliquotaIrpf'] = numberToPercent($this->irpf->aliquota($baseCalculoIrpf) * 100) . "%";
        $cltArray['decimoTerceiroLiquidoMes'] = numberToMoney($decimoTerceiroLiquidoMes);
        $cltArray['decimoTerceiroLiquidoMes'] = numberToMoney($decimoTerceiroLiquidoMes);
        $cltArray['aliquotaRealIrpf'] = numberToPercent($aliquotaRealIrpf * 100) . "%";

        $cltArray['tercoFeriasBruto'] = numberToMoney($tercoFeriasBruto);
        $cltArray['tercoFeriasInss'] = numberToMoney($tercoFeriasInss);
        $cltArray['tercoFeriasIrpf'] = numberToMoney($tercoFeriasIrpf);
        $cltArray['tercoFeriasLiquido'] = numberToMoney($tercoFeriasLiquido);
        $cltArray['tercoFeriasDescontosLiquido'] = numberToMoney($tercoFeriasDescontosLiquido);
        $cltArray['tercoFeriasPercentualBruto'] = numberToPercent(($tercoFeriasDescontosLiquido / $tercoFeriasBruto) * 100) . "%";
        $cltArray['tercoFeriasAliquotaInss'] = $this->inss->aliquotaInssPercent($tercoFeriasBruto);
        $cltArray['tercoFeriasAliquotaIrpf'] = numberToPercent($this->irpf->aliquota($tercoFeriasBaseCalculo) * 100) . "%";
        $cltArray['tercoFeriasMensalLiquido'] = numberToMoney($tercoFeriasMensalLiquido);
        $cltArray['tercoFeriasAliquotaRealIrpf'] = numberToPercent($tercoFeriasAliquotaRealIrpf * 100) . "%";

        $cltArray['fgts'] = numberToMoney($fgts);
        $cltArray['decimoTerceiroFgts'] = numberToMoney($decimoTerceiroFgts);
        $cltArray['fgtsAnual'] = numberToMoney($fgtsAnual);
        $cltArray['tercoFeriasFgts'] = numberToMoney($tercoFeriasFgts);
        $cltArray['fgtsTotalAno'] = numberToMoney($fgtsTotalAno);
        $cltArray['fgtsTotalAnoMes'] = numberToMoney($fgtsTotalAnoMes);

        $cltArray['descontosTotal'] = numberToMoney($descontosTotal);
        $cltArray['beneficiosTotal'] = numberToMoney($beneficiosTotal);
        $cltArray['percentualAlimentacao'] = $auxilioAlimentacao > 0 && $auxilioAlimentacao != "" ? numberToPercent(round(($descontoAlimentacao / $auxilioAlimentacao) * 100)) . "%" : "0%";
        $cltArray['percentualRefeicao'] = $auxilioRefeicao > 0 && $auxilioRefeicao != "" ? numberToPercent(round(($descontoRefeicao / $auxilioRefeicao) * 100)) . "%" : "0%";

        $cltArray['salarioLiquidoAposDescontosEbeneficios'] = numberToMoney($salarioLiquidoAposDescontosEbeneficios);

        $cltArray['salarioLiquidoFinal'] = numberToMoney($salarioLiquidoFinal);
        $cltArray['salarioLiquidoSemFgts'] = numberToMoney($salarioLiquidoSemFgts);
        
        $cltArray['descontoTransportePercent'] = $descontoTransportePercent;
        $cltArray['descontoTransporte'] = numberToMoney($descontoTransporte);

        $cltArray['dataSimulacao'] = date('Y-m-d H:i:s');
        $simulacoes = $this->readSimulacoes();
        $simulacoes["cltLiquido" . $codSimulacaoClt] = $cltArray;
        $this->salvarSimulacoes($simulacoes);
    }
}
