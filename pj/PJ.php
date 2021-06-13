<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";

class PJ
{

    private $filepath = __DIR__ . "/";

    private $inss;

    private $irpf;

    function __construct()
    {
        $this->inss = new INSS();
        $this->irpf = new IRPF();
    }

    function prolabore($faturamentoBruto)
    {
        return $faturamentoBruto * 0.28;
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

    function faturamentoLiquidoFinal(
        $faturamentoBruto, $aliquotaSimples, $descontos, $beneficios, 
        $certificadoDigital, $contador, $planoSaude, $planoOdontologico
    ) {
        if (strpos($faturamentoBruto, ',')) $faturamentoBruto = moneyToNumber($faturamentoBruto);
        if (strpos($certificadoDigital, ',')) $certificadoDigital = moneyToNumber($certificadoDigital);
        if (strpos($contador, ',')) $contador = moneyToNumber($contador);
        if (strpos($planoSaude, ',')) $planoSaude = moneyToNumber($planoSaude);
        if (strpos($planoOdontologico, ',')) $planoOdontologico = moneyToNumber($planoOdontologico);
        $prolabore = $this->prolabore($faturamentoBruto);
        $prolaboreInss = $this->inss->simplesNacional($prolabore);
        $prolaboreIrpf = $this->irpf->calcular($prolabore, 0, 0);
        $impostoSimples = $faturamentoBruto * ($aliquotaSimples / 100);
        $descontosTotal = $this->descontos($descontos);
        $beneficiosTotal = $this->beneficios($beneficios);

        $faturamentoLiquidoParcial1 = $faturamentoBruto - $certificadoDigital -  $contador - $planoSaude - $planoOdontologico;
        $faturamentoLiquidoParcial2 = $faturamentoLiquidoParcial1 - $impostoSimples - $prolaboreInss - $prolaboreIrpf;
        $faturamentoLiquidoParcial3 = $faturamentoLiquidoParcial2 + $beneficiosTotal - $descontosTotal;

        $faturamentoLiquidoAntesInssComplementar = $faturamentoLiquidoParcial3;

        $inssFaturamentoLiquido = $this->inss->calcular($faturamentoLiquidoAntesInssComplementar);
        $inssComplementarAoProlabore = $inssFaturamentoLiquido - $prolaboreInss;
        $inssComplementarAoProlabore = $inssComplementarAoProlabore < 0 ? 0 : $inssComplementarAoProlabore;

        $faturamentoLiquidoAposInssComplementar = $faturamentoLiquidoAntesInssComplementar - $inssComplementarAoProlabore;

        return $faturamentoLiquidoAposInssComplementar;
    }

    function formSimulacao($form) {
        $pjArray['form'] = $form;

        $codSimulacaoPj = isset($form['codSimulacaoPj']) ? $form['codSimulacaoPj'] : '';

        $faturamentoBruto = moneyToNumber($form['faturamento_bruto']);
        $certificadoDigital = moneyToNumber($form['certificado_digital']);
        $contador = moneyToNumber($form['contador']);
        $planoSaude = moneyToNumber($form['plano_saude']);
        $planoOdontologico = moneyToNumber($form['plano_odontologico']);
        $aliquotaSimples = percentToNumber($form['aliquota_simples']);

        $descontos = getFromArray($form, 'descontosPJ', array());
        $beneficios = getFromArray($form, 'beneficiosPJ', array());
        
        $prolabore = $this->prolabore($faturamentoBruto);
        $prolaboreInss = $this->inss->simplesNacional($prolabore);
        $prolaboreBaseCalculo = $this->irpf->baseCalculo($prolabore, 0, 0);
        $prolaboreIrpf = $this->irpf->calcular($prolabore, 0, 0);
        $prolaboreAliquotaInss = '11%';
        $prolaboreAliquotaIrpf = $this->irpf->aliquota($prolaboreBaseCalculo);
        $prolaboreAliquotaRealIrpf = $prolaboreIrpf/$prolabore;

        $impostoSimples = $faturamentoBruto*($aliquotaSimples/100);
        $descontosTotal = $this->descontos($descontos);
        $beneficiosTotal = $this->beneficios($beneficios);

        $faturamentoComBeneficios = $faturamentoBruto + $beneficiosTotal;

        $faturamentoLiquidoParcial1 = $faturamentoBruto - $certificadoDigital -  $contador - $planoSaude - $planoOdontologico;
        $faturamentoLiquidoParcial2 = $faturamentoLiquidoParcial1 - $impostoSimples - $prolaboreInss - $prolaboreIrpf;
        $faturamentoLiquidoParcial3 = $faturamentoLiquidoParcial2 + $beneficiosTotal - $descontosTotal;
        $descontosLiquidoSemOutrosDescontosEBeneficio = $faturamentoBruto - $faturamentoLiquidoParcial2;
        
        $faturamentoLiquidoAntesInssComplementar = $faturamentoLiquidoParcial3;

        $descontosLiquidoAntesInssComplementar = $faturamentoComBeneficios - $faturamentoLiquidoAntesInssComplementar;
        
        $inssFaturamentoLiquido = $this->inss->calcular($faturamentoLiquidoAntesInssComplementar);
        $inssComplementarAoProlabore = $inssFaturamentoLiquido - $prolaboreInss;
        $inssComplementarAoProlabore = $inssComplementarAoProlabore < 0 ? 0 : $inssComplementarAoProlabore;

        $faturamentoLiquidoAposInssComplementar = $faturamentoLiquidoAntesInssComplementar - $inssComplementarAoProlabore;

        $descontosLiquidoAposInssComplementar = $faturamentoComBeneficios - $faturamentoLiquidoAposInssComplementar;

        $pjArray['prolabore'] = numberToMoney($prolabore);
        $pjArray['prolaboreInss'] = numberToMoney($prolaboreInss);
        $pjArray['prolaboreBaseCalculo'] = numberToMoney($prolaboreBaseCalculo);
        $pjArray['prolaboreIrpf'] = numberToMoney($prolaboreIrpf);
        $pjArray['prolaboreAliquotaInss'] = $prolaboreAliquotaInss;
        $pjArray['prolaboreAliquotaIrpf'] = numberToPercent($prolaboreAliquotaIrpf * 100)."%";
        $pjArray['prolaboreAliquotaRealIrpf'] = numberToPercent($prolaboreAliquotaRealIrpf * 100)."%";
        
        $pjArray['descontosTotal'] = numberToMoney($descontosTotal);
        $pjArray['beneficiosTotal'] = numberToMoney($beneficiosTotal);
        $pjArray['impostoSimples'] = numberToMoney($impostoSimples);
    
        $pjArray['faturamentoLiquidoSemOutrosDescontosEBeneficios'] = numberToMoney($faturamentoLiquidoParcial2);
        $pjArray['faturamentoComBeneficios'] = numberToMoney($faturamentoComBeneficios);

        $pjArray['faturamentoLiquidoSemOutrosDescontosEBeneficios'] = numberToMoney($faturamentoLiquidoParcial2);
        $pjArray['faturamentoLiquidoAntesInssComplementar'] = numberToMoney($faturamentoLiquidoAntesInssComplementar);
        $pjArray['descontosLiquidoAntesInssComplementar'] = numberToMoney($descontosLiquidoAntesInssComplementar);
        $pjArray['descontosLiquidoAposInssComplementar'] = numberToMoney($descontosLiquidoAposInssComplementar);
        $pjArray['descontosLiquidoSemOutrosDescontosEBeneficio'] = numberToMoney($descontosLiquidoSemOutrosDescontosEBeneficio);
        $pjArray['percentualLiquidoAntesInssComplementar'] = numberToPercent(($descontosLiquidoAntesInssComplementar/$faturamentoComBeneficios) * 100)."%";
        $pjArray['percentualLiquidoAposInssComplementar'] = numberToPercent(($descontosLiquidoAposInssComplementar/$faturamentoComBeneficios) * 100)."%";

        $pjArray['inssFaturamentoLiquido'] = numberToMoney($inssFaturamentoLiquido);
        $pjArray['inssComplementarAoProlabore'] = numberToMoney($inssComplementarAoProlabore);
        $pjArray['faturamentoLiquidoAposInssComplementar'] = numberToMoney($faturamentoLiquidoAposInssComplementar);
        
        $pjArray['dataSimulacao'] = date('Y-m-d H:i:s');
        $simulacoes = $this->readSimulacoes();
        $simulacoes["pjLiquido".$codSimulacaoPj] = $pjArray;
        $this->salvarSimulacoes($simulacoes);
    }
}
