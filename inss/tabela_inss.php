<?php $page = 'tabelas'; ?>
<?php require_once '../header.php'; ?>
<?php
	if($erroForm != null) {
		$tabela = $erroForm;
	} else if ($tabelaCarregada != null) {
		$tabela = $tabelaCarregada;
	} else {
		$tabela['faixa1'] = array("piso"=>"","teto"=>"","percent"=>"","max"=>"");
		$tabela['faixa2'] = array("piso"=>"","teto"=>"","percent"=>"","max"=>"");
		$tabela['faixa3'] = array("piso"=>"","teto"=>"","percent"=>"","max"=>"");
		$tabela['faixa4'] = array("piso"=>"","teto"=>"","percent"=>"","max"=>"");
		$tabela['teto'] = "";
	}
?>
	<div class="row mb-3">
		<div class="col">
   			<a href="tabelas_inss_lista.php" class="btn btn-success">Lista</a>
		</div>
	</div>
	<div class="card">
	  <div class="card-header" style="font-size: 20pt;">
	    INSS <small style="font-size: 11pt;"><?= date('Y') ?></small>
	  </div>
	  <div class="card-body">
	    <h4 class="card-title text-center mb-5">Tabela de Recolhimento do INSS</h4>

	   	<form class="forms-sample" action="inss_salvar.php" method="post" 
	   		style="border-bottom: 1px solid;">
			<div class="form-group row">
				<div class="col">
            		<h5>Faixa</h5>
            	</div>
            	<div class="col">
            		<h5>Piso</h5>
            	</div>
            	<div class="col">
            		<h5>Teto</h5>
            	</div>
            	<div class="col">
            		<h5>%</h5>
            	</div>
            	<div class="col">
            		<h5>Valor Máximo</h5>
            	</div>
			</div>
            <div class="form-group row">
            	<div class="col">
            		<div class="mt-2">
            			<h6>1ª Faixa salarial</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa1[piso]" 
				        value="<?=$tabela['faixa1']['piso']?>" onchange="faixa1()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa1[teto]" 
				         value="<?=$tabela['faixa1']['teto']?>" onchange="faixa1()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa1[percent]" 
				        value="<?=$tabela['faixa1']['percent']?>" onchange="faixa1()">
				        <div class="input-group-append">
				          <div class="input-group-text">%</div>
				        </div>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control" name="faixa1[max]" 
				        value="<?=$tabela['faixa1']['max']?>" readonly> 
			      	</div>
            	</div>
            </div>
            <div class="form-group row">
            	<div class="col">
            		<div class="mt-2">
            			<h6>2ª Faixa salarial</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa2[piso]" 
				        value="<?=$tabela['faixa2']['piso']?>" onchange="faixa2()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa2[teto]" 
				        value="<?=$tabela['faixa2']['teto']?>" onchange="faixa2()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa2[percent]" 
				        value="<?=$tabela['faixa2']['percent']?>" onchange="faixa2()">
				        <div class="input-group-append">
				          <div class="input-group-text">%</div>
				        </div>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control" name="faixa2[max]" 
				        value="<?=$tabela['faixa2']['max']?>" readonly> 
			      	</div>
            	</div>
            </div>
            <div class="form-group row">
            	<div class="col">
            		<div class="mt-2">
            			<h6>3ª Faixa salarial</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa3[piso]" 
				        value="<?=$tabela['faixa3']['piso']?>" onchange="faixa3()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa3[teto]" 
				        value="<?=$tabela['faixa3']['teto']?>" onchange="faixa3()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa3[percent]" 
				        value="<?=$tabela['faixa3']['percent']?>" onchange="faixa3()">
				        <div class="input-group-append">
				          <div class="input-group-text">%</div>
				        </div>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control" name="faixa3[max]" 
				        value="<?=$tabela['faixa3']['max']?>" readonly> 
			      	</div>
            	</div>
            </div>
            <div class="form-group row">
            	<div class="col">
            		<div class="mt-2">
            			<h6>4ª Faixa salarial</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa4[piso]" 
				        value="<?=$tabela['faixa4']['piso']?>" onchange="faixa4()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa4[teto]" 
				        value="<?=$tabela['faixa4']['teto']?>" onchange="faixa4()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa4[percent]" 
				        value="<?=$tabela['faixa4']['percent']?>" onchange="faixa4()">
				        <div class="input-group-append">
				          <div class="input-group-text">%</div>
				        </div>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control" name="faixa4[max]" 
				        value="<?=$tabela['faixa4']['max']?>" readonly> 
			      	</div>
            	</div>
            </div>
         	<div class="form-group row">
            	<div class="col">
            		<div class="mt-2">
            			<h6>Teto</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="mt-2">
            			<h6>-</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="mt-2">
            			<h6>-</h6>
            		</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				       <h6>-</h6>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control" name="teto" 
				        value="<?=$tabela['teto']?>" readonly> 
			      	</div>
            	</div>
            </div>
            <div class="form-group text-center">
	       		<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        <br><br>
        <h6>Fórmula de Cálculo:</h6>
		<p class="card-text">1ª faixa salarial: R$ 1.100,00 x 7,5% = R$ 82,50</p>
		<p class="card-text">2ª faixa salarial: (R$ 2.203,48 – R$ 1.100,01) x 9% = R$ 99,31</p>
		<p class="card-text">3ª faixa salarial: (R$ 3.305,22 – R$ 2.203,49) x 12% = R$ 132,20</p>
		<p class="card-text">4ª faixa salarial: (R$ 6.433,57 – R$ 3.305,23) x 14% = R$ 437,96</p>
		<p class="card-text">Total a recolher: R$ 82,50 + R$ 99,31 + R$ 132,20 + R$ 437,96 = R$ 751,97</p>

	 	<h6>Exemplo prático de Cálculo:</h6>
		<p>Imagine que um funcionário da sua empresa tenha o salário bruto de R$ 2.500,00. De acordo com a tabela do INSS progressivo de 2020, ele deverá ter um desconto de 12% para recolhimento do INSS. Sendo assim, a conta é feita da seguinte forma:</p>
		<div class="alert alert-warning text-center">
			2.500 – 2.203,49 x 0,12 =<br>
			296,51 x 0,12 =<br>
			<strong>35,58</strong>
		</div>
		<div class="alert alert-warning text-center">
			82,50 + 99,31 + <i><b>35,58</b></i> =<br>
			<strong>217,39</strong>
		</div>
	  </div>
	</div>

<script type="text/javascript">

	function faixa1() {
		calculaValorMaximo(1)
	}
	function faixa2() {
		calculaValorMaximo(2)
	}
	function faixa3() {
		calculaValorMaximo(3)
	}
	function faixa4() {
		calculaValorMaximo(4)
	}

	function atualizaPisoProximo(i = 1) {
		const prox = i+1;
		const tetoAtual = $("input[name='faixa"+i+"[teto]']").val()
		if(tetoAtual != "") {
			const tetoFloat = moneyToFloat(tetoAtual) + 0.01
			const tetoMoney = floatToMoney(tetoFloat, { moneySign: false })
			$("input[name='faixa"+prox+"[piso]']").val(tetoMoney)	
		} else {
			$("input[name='faixa"+prox+"[piso]']").val('')
			$("input[name='faixa"+prox+"[teto]']").val('')
		}
		
		if ( prox < 4) {
			calculaValorMaximo(prox)
		}
	}

	function calculaValorMaximo(i) {
		const piso = $("input[name='faixa"+i+"[piso]']").val()
		const teto = $("input[name='faixa"+i+"[teto]']").val()
		const percent = $("input[name='faixa"+i+"[percent]']").val()
		const pisoFloat = moneyToFloat(piso)
		const tetoFloat = moneyToFloat(teto)
		const percentFloat = moneyToFloat(percent)
		const valorMax = (tetoFloat - pisoFloat)*(percentFloat/100)
		const valorMaxFloor = floatFloor(valorMax, 2)
		const valorMaxReal = floatToMoney(valorMaxFloor, { moneySign: false })

		if(tetoFloat >= pisoFloat) {
			$("input[name='faixa"+i+"[max]']").val(valorMaxReal)
		} else {
			$("input[name='faixa"+i+"[teto]']").val('')
			if(teto != '') {
				errorMessage("Para uma mesma faixa o teto não pode ser menor que o piso.(faixa"+i+")")
			}
		}
		atualizaTetoTotal()
		atualizaPisoProximo(i)
	}

	function atualizaTetoTotal() {
		const max1 = moneyToFloat($("input[name='faixa1[max]']").val())
		const max2 = moneyToFloat($("input[name='faixa2[max]']").val())
		const max3 = moneyToFloat($("input[name='faixa3[max]']").val())
		const max4 = moneyToFloat($("input[name='faixa4[max]']").val())
		const total = max1 + max2 + max3 + max4
		const totalFloor = total
		const totalMoney = floatToMoney(totalFloor, { moneySign: false })
		$("input[name='teto'").val(totalMoney)
	}
</script>
<?php require_once '../footer.php'; ?>

