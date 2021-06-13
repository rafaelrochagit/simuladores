<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";
require_once __DIR__ . "/../clt/CLT.php";
require_once __DIR__ . "/../pj/PJ.php";

class CLT_PJ
{

    private $filepath = __DIR__ . "/";
    private $inss;
    private $irpf;
    private $clt;
    private $pj;

    function __construct()
    {
        $this->inss = new INSS();
        $this->irpf = new IRPF();
        $this->clt = new CLT();
        $this->pj = new PJ();
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

    function cltPjEquivalente(
        $salarioLiquidoFinal, $aliquotaSimples, $descontos, $beneficios, 
        $certificadoDigital, $contador, $planoSaude, $planoOdontologico
    ) {
        $salarioLiquidoFinal =  round($salarioLiquidoFinal, 2); 
        $limiteTeto = $salarioLiquidoFinal*4;
        $limitePiso = $salarioLiquidoFinal;

        $faturamentoBruto = round(($limiteTeto + $limitePiso)/2, 2); 

        $faturamentoLiquidoFinal = $this->pj->faturamentoLiquidoFinal(
            $faturamentoBruto, $aliquotaSimples, $descontos, $beneficios, 
            $certificadoDigital, $contador, $planoSaude, $planoOdontologico
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
            
            $faturamentoLiquidoFinal = $this->pj->faturamentoLiquidoFinal(
                $faturamentoBruto, $aliquotaSimples, $descontos, $beneficios, 
                $certificadoDigital, $contador, $planoSaude, $planoOdontologico
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