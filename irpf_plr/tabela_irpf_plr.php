<?php $page = 'tabelas'; ?>
<?php require_once '../header.php'; ?>
<?php
	if($erroForm != null) {
		$tabelaIrpfPlr = $erroForm;
	} else if ($tabelaIrpfPlrCarregada != null) {
		$tabelaIrpfPlr = $tabelaIrpfPlrCarregada;
	} else {
		$tabelaIrpf['faixa1'] = array("piso"=>"","teto"=>"","percent"=>"","deducao"=>"");
		$tabelaIrpf['faixa2'] = array("piso"=>"","teto"=>"","percent"=>"","deducao"=>"");
		$tabelaIrpf['faixa3'] = array("piso"=>"","teto"=>"","percent"=>"","deducao"=>"");
		$tabelaIrpf['faixa4'] = array("piso"=>"","teto"=>"","percent"=>"","deducao"=>"");
		$tabelaIrpf['faixa5'] = array("piso"=>"","teto"=>"-","percent"=>"","deducao"=>"");
	}
?>
	<div class="row mb-3">
		<div class="col">
   			<a href="tabelas_irpf_plr_lista.php" class="btn btn-success">Lista</a>
		</div>
	</div>
	<div class="card">
	  <div class="card-header" style="font-size: 20pt;">
	    IRPF PLR <small style="font-size: 11pt;"><?= date('Y') ?></small>
	  </div>
	  <div class="card-body">
	    <h4 class="card-title text-center mb-5">Tabela de Recolhimento do IRPF PLR</h4>

	   	<form class="forms-sample" action="salvar.php" method="post" 
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
            		<h5>Dedução</h5>
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
				        value="<?=$tabelaIrpfPlr['faixa1']['piso']?>" onchange="faixa1()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa1[teto]" 
				         value="<?=$tabelaIrpfPlr['faixa1']['teto']?>" onchange="faixa1()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa1[percent]" 
				        value="<?=$tabelaIrpfPlr['faixa1']['percent']?>" onchange="faixa1()">
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
				        <input class="form-control money" name="faixa1[deducao]" 
				        value="<?=$tabelaIrpfPlr['faixa1']['deducao']?>" > 
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
				        value="<?=$tabelaIrpfPlr['faixa2']['piso']?>" onchange="faixa2()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa2[teto]" 
				        value="<?=$tabelaIrpfPlr['faixa2']['teto']?>" onchange="faixa2()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa2[percent]" 
				        value="<?=$tabelaIrpfPlr['faixa2']['percent']?>" onchange="faixa2()">
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
				        <input class="form-control money" name="faixa2[deducao]" 
				        value="<?=$tabelaIrpfPlr['faixa2']['deducao']?>" > 
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
				        value="<?=$tabelaIrpfPlr['faixa3']['piso']?>" onchange="faixa3()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa3[teto]" 
				        value="<?=$tabelaIrpfPlr['faixa3']['teto']?>" onchange="faixa3()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa3[percent]" 
				        value="<?=$tabelaIrpfPlr['faixa3']['percent']?>" onchange="faixa3()">
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
				        <input class="form-control money" name="faixa3[deducao]" 
				        value="<?=$tabelaIrpfPlr['faixa3']['deducao']?>" > 
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
				        value="<?=$tabelaIrpfPlr['faixa4']['piso']?>" onchange="faixa4()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa4[teto]" 
				        value="<?=$tabelaIrpfPlr['faixa4']['teto']?>" onchange="faixa4()"> 
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <input class="form-control percent" name="faixa4[percent]" 
				        value="<?=$tabelaIrpfPlr['faixa4']['percent']?>" onchange="faixa4()">
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
				        <input class="form-control money" name="faixa4[deducao]" 
				        value="<?=$tabelaIrpfPlr['faixa4']['deducao']?>" > 
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
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">R$</div>
							</div>
							<input class="form-control money" name="faixa5[piso]" 
							value="<?=$tabelaIrpfPlr['faixa5']['piso']?>" onchange="teto()"> 
						</div>
            	</div>
            	<div class="col">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">R$</div>
							</div>
							<input class="form-control" name="faixa5[teto]" 
							value="<?=$tabelaIrpfPlr['faixa5']['teto']?>" readonly> 
						</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
						<div class="input-group">
							<input class="form-control percent" name="faixa5[percent]" 
							value="<?=$tabelaIrpfPlr['faixa5']['percent']?>" onchange="teto()">
							<div class="input-group-append">
							<div class="input-group-text">%</div>
							</div>
						</div>
			      	</div>
            	</div>
            	<div class="col">
	            	<div class="input-group">
				        <div class="input-group-prepend">
				          <div class="input-group-text">R$</div>
				        </div>
				        <input class="form-control money" name="faixa5[deducao]" 
				        value="<?=$tabelaIrpfPlr['faixa5']['deducao']?>" > 
			      	</div>
            	</div>
            </div>
            <div class="form-group text-center">
	       		<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
        <br><br>
        <h6>Fórmula de Cálculo:</h6>
		<div class="alert alert-warning text-center">
			<strong>Base de cálculo = </strong> salário bruto
		</div>
		<div class="alert alert-warning text-center">
			<strong>IRRF PLR = </strong>base de cálculo x alíquota - dedução
		</div>
	  </div>
	</div>

<script type="text/javascript">

	function faixa1() {
		verificaPisoTeto(1)
	}
	function faixa2() {
		verificaPisoTeto(2)
	}
	function faixa3() {
		verificaPisoTeto(3)
	}
	function faixa4() {
		verificaPisoTeto(4)
	}
	function teto() {
		verificaPisoTeto(5)
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
		
		if ( prox < 5) {
			atualizaPisoProximo(i)
		}
	}

	function verificaPisoTeto(i) {
		const piso = $("input[name='faixa"+i+"[piso]']").val()
		const teto = $("input[name='faixa"+i+"[teto]']").val()
		const percent = $("input[name='faixa"+i+"[percent]']").val()
		const pisoFloat = moneyToFloat(piso)
		const tetoFloat = moneyToFloat(teto)
		const percentFloat = moneyToFloat(percent)
		const valorMax = (tetoFloat - pisoFloat)*(percentFloat/100)
		const valorMaxFloor = floatFloor(valorMax, 2)
		const valorMaxReal = floatToMoney(valorMaxFloor, { moneySign: false })

		if(teto != "" && teto != "-" && tetoFloat < pisoFloat) {
			$("input[name='faixa"+i+"[teto]']").val('')
			if(teto != '') {
				errorMessage("Para uma mesma faixa o teto não pode ser menor que o piso.(faixa"+i+")")
			}
		}
		atualizaPisoProximo(i)
	}

</script>
<?php require_once '../footer.php'; ?>

