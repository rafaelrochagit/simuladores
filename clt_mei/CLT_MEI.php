<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";
require_once __DIR__ . "/../clt/CLT.php";
require_once __DIR__ . "/../mei/MEI.php";

class CLT_MEI
{

    private $filepath = __DIR__ . "/";
    private $inss;
    private $irpf;
    private $clt;
    private $mei;

    function __construct()
    {
        $this->inss = new INSS();
        $this->irpf = new IRPF();
        $this->clt = new CLT();
        $this->mei = new MEI();
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

    function cltMeiEquivalente(
        $salarioLiquidoFinal, $das, $descontos, $beneficios
    ) {
        $salarioLiquidoFinal =  round($salarioLiquidoFinal, 2); 
        $limiteTeto = $salarioLiquidoFinal*4;
        $limitePiso = $salarioLiquidoFinal;

        $faturamentoBruto = round(($limiteTeto + $limitePiso)/2, 2); 

        $faturamentoLiquidoFinal = $this->mei->faturamentoLiquidoFinal(
            $faturamentoBruto, $das, $descontos, $beneficios
        );

        while($faturamentoLiquidoFinal != $salarioLiquidoFinal) {
            if($faturamentoLiquidoFinal > $salarioLiquidoFinal) {
                $limiteTeto = $faturamentoBruto;
            } else {
                $limitePiso = $faturamentoBruto;
            }
            echo '<br>';
            echo 'Faturamento Bruto ';
            echo $faturamentoBruto;
            echo '<br>';
            echo 'limiteTeto ';
            echo $limiteTeto;
            echo '<br>';
            echo 'limitePiso ';
            echo $limitePiso;
            echo '<br>';

            $faturamentoBruto = round(($limiteTeto + $limitePiso)/2, 2); 
            
            $faturamentoLiquidoFinal = $this->mei->faturamentoLiquidoFinal(
                $faturamentoBruto, $das, $descontos, $beneficios
            );

            $faturamentoLiquidoFinal = round($faturamentoLiquidoFinal, 2); 

            echo 'faturamentoLiquidoFinal ';
            echo $faturamentoLiquidoFinal;
            echo '<br>';
            echo 'salarioLiquidoFinal ';
            echo $salarioLiquidoFinal;
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }

        return $faturamentoBruto;
    }
}