<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";

class PONTO
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
        $pontoArray['form'] = $form;

        $codSimulacaoPonto = isset($form['codSimulacaoPonto']) ? $form['codSimulacaoPonto'] : '';

        $horas =$form['horas'];
        $meta = new DateTime($form['meta']);

        $metaMinutos = intval($meta->format('H'))*60 + intval($meta->format("i"));

        $j=0;
        $diferencas = array();
        $minutosTrabalhados = 0;
        $primeiraEntrada = new DateTime(current($horas));
        foreach($horas as $index => $hora) {
            if($j%2 != 0 && isset($horas[$index - 1])) {
                $entrada = $horas[$index-1];
                $saida = $hora;
                $entradaTime = new DateTime($entrada);
                $saidaTime = new DateTime($saida);
                $diferencaInterval = $saidaTime->diff($entradaTime);
                $diferenca = new DateTime();
                $diferenca->setTime($diferencaInterval->h, $diferencaInterval->i, 0);
                $diferencas[] = $diferenca->format('H:i');
                $minutosTrabalhados += ($diferencaInterval->h*60 + $diferencaInterval->i);
            } 
            $j++;
        }
        
        $minutosFaltantes = $metaMinutos - $minutosTrabalhados;
        $minutosFaltantes = $minutosFaltantes > 0 ? $minutosFaltantes : 0;
        
        $totalMinutos = $minutosTrabalhados + $minutosFaltantes;
        
        $ultimaEntrada = new DateTime(end($horas));
        $dataFinal = clone $ultimaEntrada;
        $dataFinal = $dataFinal->modify("+{$minutosFaltantes} minutes");
        $horaFinal = $dataFinal->format('H:i');

        $horasDiferencaAteFinal =  intval($minutosFaltantes/60);
        $minutosDiferencaAteFinal = intval($minutosFaltantes%60); 
        $timeDiferencaAteFinal = (new DateTime())->setTime($horasDiferencaAteFinal, $minutosDiferencaAteFinal, 0)->format("H:i");
        
        $horasTotal =  intval($totalMinutos/60);
        $minutosTotal = intval($totalMinutos%60); 
        $timeTotal = (new DateTime())->setTime($horasTotal, $minutosTotal, 0)->format("H:i");

        $pontoArray['ultimaEntrada'] = $ultimaEntrada->format("H:i");
        $pontoArray['horaInicial'] = $primeiraEntrada->format("H:i");
        $pontoArray['horaFinal'] =  $horaFinal;
        $pontoArray['timeTotal'] =  $timeTotal;
        $pontoArray['timeDiferencaAteFinal'] =  $timeDiferencaAteFinal;
        $pontoArray['diferencas'] =  $diferencas;
        $pontoArray['dataSimulacao'] = date('Y-m-d H:i:s');
        $simulacoes = $this->readSimulacoes();
        $simulacoes["ponto".$codSimulacaoPonto] = $pontoArray;
        $this->salvarSimulacoes($simulacoes);
    }
}
