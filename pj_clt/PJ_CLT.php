<?php
require_once __DIR__ . "/../util.php";
require_once __DIR__ . "/../inss/INSS.php";
require_once __DIR__ . "/../irpf/IRPF.php";
require_once __DIR__ . "/../clt/CLT.php";
require_once __DIR__ . "/../pj/PJ.php";

class PJ_CLT
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

    function pjCltEquivalente(
        $faturamentoLiquidoFinal, 
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
        $auxilio_transporte_check,
        $plr,
        $sindicato_check
    ) {
        $faturamentoLiquidoFinal = round($faturamentoLiquidoFinal, 2); 

        $limiteTeto = $faturamentoLiquidoFinal*4;
        $limitePiso = 0;

        $salarioBruto = round(($limiteTeto + $limitePiso)/2, 2); 
        if($auxilio_transporte_check) $descontoTransporte = $salarioBruto*0.06;

        $valorSindicatoAnual = 0;
        if($sindicato_check) {
            $valorSindicatoAnual = $salarioBruto/30;
        } 
        $valorSindicatoMensal = $valorSindicatoAnual/12;

        $salarioLiquidoFinal = $this->clt->salarioLiquidoFinal(
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
            $valorSindicatoMensal
        );

        $i=0;

        while($salarioLiquidoFinal != $faturamentoLiquidoFinal && $i<30) {
            if($salarioLiquidoFinal > $faturamentoLiquidoFinal) {
                $limiteTeto = $salarioBruto;
            } else {
                $limitePiso = $salarioBruto;
            }
            $i++;
           

            $salarioBruto = round(($limiteTeto + $limitePiso)/2, 2); 
            if($auxilio_transporte_check) $descontoTransporte = $salarioBruto*0.06;

            if($sindicato_check) {
                $valorSindicatoAnual = $salarioBruto/30;
            } 
            $valorSindicatoMensal = $valorSindicatoAnual/12;

            $salarioLiquidoFinal = $this->clt->salarioLiquidoFinal(
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
                $valorSindicatoMensal
            );

            $salarioLiquidoFinal = round($salarioLiquidoFinal, 2); 

            echo '<br>';
            echo 'Salário Bruto ';
            echo $salarioBruto;
            echo '<br>';
            echo 'limiteTeto ';
            echo $limiteTeto;
            echo '<br>';
            echo 'limitePiso ';
            echo $limitePiso;
            echo '<br>';

            echo 'salarioLiquidoFinal ';
            echo $salarioLiquidoFinal;
            echo '<br>';
            echo 'faturamentoLiquidoFinal ';
            echo $faturamentoLiquidoFinal;
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }

        return $salarioBruto;
    }
}