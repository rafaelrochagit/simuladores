<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";

class MEI
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

    function faturamentoLiquidoFinal($faturamentoBruto, $das, $descontos, $beneficios) {
        if (strpos($faturamentoBruto, ',')) $faturamentoBruto = moneyToNumber($faturamentoBruto);
        if (strpos($das, ',')) $das = moneyToNumber($das);
        $descontosTotal = $this->descontos($descontos);
        $beneficiosTotal = $this->beneficios($beneficios);

        $faturamentoLiquidoParcial1 = $faturamentoBruto - $das;
        $faturamentoLiquidoParcial3 = $faturamentoLiquidoParcial1 + $beneficiosTotal - $descontosTotal;

        $faturamentoLiquidoAntesInssComplementar = $faturamentoLiquidoParcial3;

        $inssFaturamentoLiquido = $this->inss->calcular($faturamentoLiquidoAntesInssComplementar);
        $inssComplementarAoProlabore = $inssFaturamentoLiquido - $das;
        $inssComplementarAoProlabore = $inssComplementarAoProlabore < 0 ? 0 : $inssComplementarAoProlabore;

        $faturamentoLiquidoAposInssComplementar = $faturamentoLiquidoAntesInssComplementar - $inssComplementarAoProlabore;

        return $faturamentoLiquidoAposInssComplementar;
    }

    function formSimulacao($form) {
        $meiArray['form'] = $form;

        $codSimulacaoMei = isset($form['codSimulacaoMei']) ? $form['codSimulacaoMei'] : '';

        $faturamentoBruto = moneyToNumber($form['faturamento_bruto']);
        $das = moneyToNumber($form['das']);

        $descontos = getFromArray($form, 'descontosMEI', array());
        $beneficios = getFromArray($form, 'beneficiosMEI', array());
        
        $descontosTotal = $this->descontos($descontos);
        $beneficiosTotal = $this->beneficios($beneficios);

        $faturamentoComBeneficios = $faturamentoBruto + $beneficiosTotal;

        $faturamentoLiquidoParcial1 = $faturamentoBruto - $das;
        $faturamentoLiquidoParcial3 = $faturamentoLiquidoParcial1 + $beneficiosTotal - $descontosTotal;

        $descontosLiquidoSemOutrosDescontosEBeneficio = $faturamentoBruto - $faturamentoLiquidoParcial1;
        
        $faturamentoLiquidoAntesInssComplementar = $faturamentoLiquidoParcial3;

        $descontosLiquidoAntesInssComplementar = $faturamentoComBeneficios - $faturamentoLiquidoAntesInssComplementar;
        
        $inssFaturamentoLiquido = $this->inss->calcular($faturamentoLiquidoAntesInssComplementar);
        $inssComplementarAoProlabore = $inssFaturamentoLiquido - $das;
        $inssComplementarAoProlabore = $inssComplementarAoProlabore < 0 ? 0 : $inssComplementarAoProlabore;

        $faturamentoLiquidoAposInssComplementar = $faturamentoLiquidoAntesInssComplementar - $inssComplementarAoProlabore;

        $descontosLiquidoAposInssComplementar = $faturamentoComBeneficios - $faturamentoLiquidoAposInssComplementar;

        $meiArray['descontosTotal'] = numberToMoney($descontosTotal);
        $meiArray['beneficiosTotal'] = numberToMoney($beneficiosTotal);
    
        $meiArray['faturamentoComBeneficios'] = numberToMoney($faturamentoComBeneficios);

        $meiArray['faturamentoLiquidoAntesInssComplementar'] = numberToMoney($faturamentoLiquidoAntesInssComplementar);
        $meiArray['descontosLiquidoAntesInssComplementar'] = numberToMoney($descontosLiquidoAntesInssComplementar);
        $meiArray['descontosLiquidoAposInssComplementar'] = numberToMoney($descontosLiquidoAposInssComplementar);
        $meiArray['descontosLiquidoSemOutrosDescontosEBeneficio'] = numberToMoney($descontosLiquidoSemOutrosDescontosEBeneficio);
        $meiArray['percentualLiquidoAntesInssComplementar'] = numberToPercent(($descontosLiquidoAntesInssComplementar/$faturamentoComBeneficios) * 100)."%";
        $meiArray['percentualLiquidoAposInssComplementar'] = numberToPercent(($descontosLiquidoAposInssComplementar/$faturamentoComBeneficios) * 100)."%";

        $meiArray['inssFaturamentoLiquido'] = numberToMoney($inssFaturamentoLiquido);
        $meiArray['inssComplementarAoProlabore'] = numberToMoney($inssComplementarAoProlabore);
        $meiArray['faturamentoLiquidoAposInssComplementar'] = numberToMoney($faturamentoLiquidoAposInssComplementar);
        
        $meiArray['dataSimulacao'] = date('Y-m-d H:i:s');
        $simulacoes = $this->readSimulacoes();
        $simulacoes["meiLiquido".$codSimulacaoMei] = $meiArray;
        $this->salvarSimulacoes($simulacoes);
    }
}
