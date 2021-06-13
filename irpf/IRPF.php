<?php
require_once __DIR__."/../util.php";
require_once __DIR__."/../inss/INSS.php";

class IRPF {

	private $filepath = __DIR__."/";
	private $inss;

	public function __construct() {
		$this->inss = new INSS();
	}

	function salvar($tabela) {
		$id = date('YmdHi');
		$tabelaJson = json_encode($tabela);
		file_put_contents($this->filepath."tabelas/".$id."_tabela_irpf.json", $tabelaJson);
	}

	function readTabelas() {
		$types = array('json');
		$path = 'tabelas';
		$dir = new DirectoryIterator($this->filepath.$path);
		$tabelas = array();
		foreach ($dir as $fileInfo) {
		    $ext = strtolower( $fileInfo->getExtension() );
		    if( in_array( $ext, $types ) ) $tabelas[] = $fileInfo->getFilename();
		}
		return $tabelas;
	}

	function readJson($tabelaNome) {
		$tabelaJson = @file_get_contents($this->filepath."tabelas/".$tabelaNome);
		return $tabelaJson;
	}

	function read($tabelaNome) {
		$tabelaJson = $this->readJson($tabelaNome);
		if($tabelaJson) {
			return json_decode($tabelaJson, true);
		}
		return null;
	}

	function delete($tabelaNome) {
		unlink($this->filepath."tabelas/".$tabelaNome);
	}

	function selecionar($tabelaNome) {
		$configuracaoJson = file_get_contents(__DIR__."/../configuracoes/config.json");

        $configuracoes = array();
        if($configuracaoJson) {
            $configuracoes = json_decode($configuracaoJson, true);
        }

        $configuracoes['tabela_irpf'] = $tabelaNome;
        $configuracoesJson = json_encode($configuracoes);
		file_put_contents(__DIR__."/../configuracoes/config.json", $configuracoesJson);
	}

	function calcular($salario, $dependentes, $pensao) {
		$baseCalculo = $this->baseCalculo($salario, $dependentes, $pensao);
		$aliquota = $this->aliquota($baseCalculo);
		$deducao = $this->deducao($baseCalculo);
		$irpf = ($baseCalculo * $aliquota) - $deducao;
		return round($irpf,2);
	}

	function baseCalculo($salario, $dependentes, $pensao) {
		if (strpos($salario, ',')) $salario = moneyToNumber($salario);

		if (strpos($pensao, ',')) $pensao = moneyToNumber($pensao);
		
		$fatorBase = 189.59;
		$inss = $this->inss->calcular($salario);
		return $salario - $inss - $pensao - ($dependentes*$fatorBase);
	}

	function aliquota($baseCalculo) {
		if (strpos($baseCalculo, ',')) $baseCalculo = moneyToNumber($baseCalculo);
		$config = readConfig();
		$tabelaNome = isset($config['tabela_irpf']) ? $config['tabela_irpf'] : '';
		$tabelaCarregada = $this->read($tabelaNome); 
		if($tabelaCarregada) {
			$tabela = $this->convertTabelaMoneyToNumber($tabelaCarregada);
			
			if($baseCalculo <= $tabela['faixa1']['teto']) return $tabela['faixa1']['percent']/100;
			if($baseCalculo <= $tabela['faixa2']['teto']) return $tabela['faixa2']['percent']/100;
			if($baseCalculo <= $tabela['faixa3']['teto']) return $tabela['faixa3']['percent']/100;
			if($baseCalculo <= $tabela['faixa4']['teto']) return $tabela['faixa4']['percent']/100;
			return $tabela['faixa5']['percent']/100;
		} else {
			return 0;
		}
	}

	
	function deducao($baseCalculo) {
		if (strpos($baseCalculo, ',')) $baseCalculo = moneyToNumber($baseCalculo);
		$config = readConfig();
		$tabelaNome = isset($config['tabela_irpf']) ? $config['tabela_irpf'] : '';
		$tabelaCarregada = $this->read($tabelaNome); 
		if($tabelaCarregada) {
			$tabela = $this->convertTabelaMoneyToNumber($tabelaCarregada);
			if($baseCalculo <= $tabela['faixa1']['teto']) return $tabela['faixa1']['deducao'];
			if($baseCalculo <= $tabela['faixa2']['teto']) return $tabela['faixa2']['deducao'];
			if($baseCalculo <= $tabela['faixa3']['teto']) return $tabela['faixa3']['deducao'];
			if($baseCalculo <= $tabela['faixa4']['teto']) return $tabela['faixa4']['deducao'];
			return $tabela['faixa5']['deducao'];
		} else {
			return 0;
		}
	}

	function convertTabelaMoneyToNumber($tabelaCarregada) {
		foreach($tabelaCarregada as $i => $tabela) {
			foreach($tabela as $j => $t) {
				$tabelaCarregada[$i][$j] = moneyToNumber($t);
			}
		}
		return $tabelaCarregada;
	}
}