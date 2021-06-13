<?php
require_once __DIR__."/../util.php";

class INSS {
	private $filepath = __DIR__."/";
	
	function salvar($tabela) {
		$id = date('YmdHi');
		$tabelaJson = json_encode($tabela);
		file_put_contents($this->filepath."/tabelas_inss/".$id."_tabela_inss.json", $tabelaJson);
	}

	function readTabelas() {
		$types = array('json');
		$dir = new DirectoryIterator($this->filepath."/tabelas_inss");
		$tabelas = array();
		foreach ($dir as $fileInfo) {
		    $ext = strtolower( $fileInfo->getExtension() );
		    if( in_array( $ext, $types ) ) $tabelas[] = $fileInfo->getFilename();
		}
		return $tabelas;
	}

	function readJson($tabelaNome) {
		$tabelaJson = @file_get_contents($this->filepath."tabelas_inss/".$tabelaNome);
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
		unlink($this->filepath."/tabelas_inss/".$tabelaNome);
	}

	function selecionar($tabelaNome) {
		$configuracaoJson = file_get_contents(__DIR__."/../configuracoes/config.json");

        $configuracoes = array();
        if($configuracaoJson) {
            $configuracoes = json_decode($configuracaoJson, true);
        }

        $configuracoes['tabela_inss'] = $tabelaNome;
        $configuracoesJson = json_encode($configuracoes);
		file_put_contents(__DIR__."/../configuracoes/config.json", $configuracoesJson);
	}

	function calcular($salario) {
		$config = readConfig();
		$tabelaNome = isset($config['tabela_inss']) ? $config['tabela_inss'] : '';
		$tabelaCarregada = $this->read($tabelaNome); 
		if($tabelaCarregada) {
			$tabela = $this->convertTabelaMoneyToNumber($tabelaCarregada);
			if (strpos($salario, ',')) $salario = moneyToNumber($salario);
			$faixa1 = $this->valorFaixa($salario, $tabela['faixa1']);
			$faixa2 = $this->valorFaixa($salario, $tabela['faixa2']);
			$faixa3 = $this->valorFaixa($salario, $tabela['faixa3']);
			$faixa4 = $this->valorFaixa($salario, $tabela['faixa4']);
			$inss = $faixa1 + $faixa2 + $faixa3 + $faixa4;
			return round($inss,2);
		} else {
			return 0;
		}
	}

	function simplesNacional($salario) {
		return $salario*0.11;
	}


	function aliquota($salario) {
		$config = readConfig();
		$tabelaNome = isset($config['tabela_inss']) ? $config['tabela_inss'] : '';
		$tabelaCarregada = $this->read($tabelaNome); 
		if($tabelaCarregada) {
			$tabela = $this->convertTabelaMoneyToNumber($tabelaCarregada);
			if (strpos($salario, ',')) $salario = moneyToNumber($salario);
			if($salario <= $tabela['faixa1']['teto']) return $tabela['faixa1']['percent']/100;
			if($salario <= $tabela['faixa2']['teto']) return $tabela['faixa2']['percent']/100;
			if($salario <= $tabela['faixa3']['teto']) return $tabela['faixa3']['percent']/100;
			if($salario <= $tabela['faixa4']['teto']) return $tabela['faixa4']['percent']/100;
			return 'Teto';
		} else {
			return 0;
		}
	}

	function aliquotaInssPercent($salario) {
		$aliquota = $this->aliquota($salario);
		if ($aliquota != 'Teto') {
			return numberToPercent($aliquota*100)." %";
		}
		return $aliquota;
	}


	function convertTabelaMoneyToNumber($tabelaCarregada) {
		foreach($tabelaCarregada as $i => $tabela) {
			if($i != 'teto') {
				foreach($tabela as $j => $t) {
					$tabelaCarregada[$i][$j] = moneyToNumber($t);
				}
			}
		}
		$tabelaCarregada['teto'] = moneyToNumber($tabelaCarregada['teto']);
		return $tabelaCarregada;
	}

	function valorFaixa($salario, $faixa) {
		$valor = 0;
		if ($salario >= $faixa['piso'] && $salario <= $faixa['teto']) {
			$valor = ($salario-$faixa['piso']) * ($faixa['percent']/100);
		} else if ($salario > $faixa['teto']) {
			$valor = $faixa['max'];
		}
		return $valor;
	}
}