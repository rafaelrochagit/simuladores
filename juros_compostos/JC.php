<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";

class JC
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

    function formSimulacao($form) {
        $jcArray['form'] = $form;

        $codSimulacaoJc = isset($form['codSimulacaoJc']) ? $form['codSimulacaoJc'] : '';

        $valorInicial = moneyToNumber($form['valor_inicial']);
        $aporte = moneyToNumber($form['aporte']);
        $porcentagemValor = percentToNumber($form['porcentagem'])/100;
        $corretagemValor = percentToNumber($form['corretagem'])/100;
        $retiradaValor = percentToNumber($form['retirada'])/100;
        $periodo = $form['periodo'];

        $porcentagemTotal = pow((1+$porcentagemValor), $periodo) - 1;
        $taxaCorretagemTotal = pow((1+$corretagemValor), $periodo) - 1;
        $taxaRetiradaTotal = pow((1+$retiradaValor), $periodo) - 1;
        //$valorFinalTotal = $valorInicial*pow((1+$porcentagemValor), $periodo);

        //$meiArray['valorInicial'] = numberToMoney($valorInicial);
        //$meiArray['porcentagem'] = numberToPercent($porcentagem);
        $detalhado = array();
        $valorBase = $valorInicial;
        $totalCorretagem = 0;
        $totalRetirada = 0;
        $valorFinal = $valorBase;
        $valorFinalBase = $valorBase;

        $aporteTotal = 0;
        for($i = 1; $i <= $periodo; $i++) {
            $detalhado[$i]['periodo'] = $i;
            $detalhado[$i]['aporte'] = numberToMoney(0);
            $detalhado[$i]['valorBaseAntesAporte'] = numberToMoney($valorBase);
            if($i > 1) {
                $valorBase += $aporte;
                $detalhado[$i]['aporte'] = numberToMoney($aporte);
                $aporteTotal += $aporte;
            } 
            $detalhado[$i]['valorBase'] = numberToMoney($valorBase);
            $valorNovo = $valorBase*(1+$porcentagemValor);
            $valorFinalBase = $valorNovo;
            $detalhado[$i]['valorNovo'] = numberToMoney($valorNovo);
            $corretagem = $valorNovo*$corretagemValor;
            $detalhado[$i]['corretagem'] = numberToMoney($corretagem);
            $retirada = $valorNovo*$retiradaValor;
            $detalhado[$i]['retirada'] = numberToMoney($retirada);
            $valorFinalPeriodo = $valorNovo - $corretagem - $retirada;
            $detalhado[$i]['valorFinal'] = numberToMoney($valorFinalPeriodo);
            $totalCorretagem+= $corretagem;
            $totalRetirada+= $retirada;
            $valorBase = $valorFinalPeriodo;
            $valorFinal = $valorBase;

        }

        $ganhoTotal = $valorFinal - $inicialMaisAporte;
        
        $jcArray['detalhe'] = $detalhado;
        $jcArray['totalCorretagem'] = numberToMoney($totalCorretagem);
        $jcArray['totalRetirada'] = numberToMoney($totalRetirada);

        $jcArray['valorFinal'] = numberToMoney($valorFinal);
        $jcArray['valorFinalBase'] = numberToMoney($valorFinalBase);
        //$jcArray['valorFinalTotal'] = numberToMoney($valorFinalTotal);
        $jcArray['aporteTotal'] = numberToMoney($aporteTotal);
        $jcArray['inicialMaisAporte'] = numberToMoney($valorInicial + $aporteTotal);
        $jcArray['ganhoTotal'] = numberToMoney($ganhoTotal);
        $jcArray['taxaJurosTotal'] = numberToPercent($porcentagemTotal*100);
        $jcArray['taxaCorretagemTotal'] = numberToPercent($taxaCorretagemTotal*100);
        $jcArray['taxaRetiradaTotal'] = numberToPercent($taxaRetiradaTotal*100);
        $jcArray['dataSimulacao'] = date('Y-m-d H:i:s');
        $simulacoes = $this->readSimulacoes();
        $simulacoes["jc".$codSimulacaoJc] = $jcArray;
        $this->salvarSimulacoes($simulacoes);
    }
}
