<?php $page = 'mei_clt'; ?>
<?php 
require_once '../header.php'; 
$form = getFromArray($cltLiquido, 'form');
$salario_bruto = getFromArray($form, 'salario_bruto', '-');
?>
<style>
	#CLT {
		display: none;
	}

	#MEI {
		display: block;
	}

	#salarioBruto {
		display: none;
	}

</style>
<div class="card">
	<div class="card-header text-center" style="font-size: 20pt;">
		MEI x CLT <small style="font-size: 11pt;"><?= date('Y') ?></small>
	</div>
	<div class="card-body">
		
		<form class="forms-sample d-print-none" action="calcular_mei_clt.php" method="post" style="border-bottom: 1px solid;">
			<div id="MEI">
				<div class="row">
					<div class="col-8">
						<?php if($usuarioLogado): ?>
							<a class="btn btn-info" href="lista_simulacoes.php">Últimas Simulações</a>
						<?php endif; ?>
					</div>
					<div class="col-2 mt-1">
						<b>COD MEI</b>		
					</div>
					<div class="col-2">
						<div class="form-group text-left">
							<input id="codSimulacaoClt" class="form-control" type="number" name="codSimulacaoMei" value="<?= $codSimulacaoMei ?>" readonly>
						</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col">
						<h4>MEI</h4>
					</div>
				</div>
				<?php require_once '../mei/form_mei.php' ?>
				<div class="row mb-4">
					<div class="col text-center">
						<a class="btn btn-dark" onclick="toCLT()">Próximo ></a>
					</div>
				</div>
			</div>
			<div id="CLT">
				<div class="row">
					<div class="col-8">
						<a class="btn btn-info" href="lista_simulacoes.php">Últimas Simulações</a>
					</div>
					<div class="col-2 mt-1">
						<b>COD CLT</b>		
					</div>
					<div class="col-2">
						<div class="form-group text-left">
							<input id="codSimulacaoClt" class="form-control" type="number" name="codSimulacaoClt" value="<?= $codSimulacaoClt?>" readonly>
						</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col">
						<h4>CLT</h4>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-2">
						<div class="mt-2">
							<h6>Salário Bruto</h6>
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">R$</div>
							</div>
							<input class="form-control" name="salario_bruto" value="<?= $salario_bruto ?>" readonly>
						</div>
					</div>
					<div class="col-2 mt-2">
						<?php if(moneyToNumber($salario_bruto) >0 && moneyToNumber($salario_bruto) < 1100): ?>
						<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="right" 
							title="Salário menor que o <b>salário mínimo</b>: R$ 1.100,00"></i>
						<?php endif; ?>
					</div>
				</div>
				<?php require_once '../clt/form_clt.php' ?>
				<div class="row mb-4">
					<div class="col text-center">
						<a class="btn btn-dark" onclick="toMEI()">< Voltar</a>
						<button type="submit" class="btn btn-primary">Calcular</button>
					</div>
				</div>
			</div>
		</form>
		<div id="resultCltMei">
			<div class="row">
				<div class="col mb-3">
					<span  style="width:100%" class="btn btn-dark" data-toggle="modal" data-target="#meiTable">MEI</span>
				</div>
				<div class="col mb-3">
					<span  style="width:100%" class="btn btn-success" data-toggle="modal" data-target="#cltTable">CLT</span>
				</div>
			</div>
		</div>
	
		
	</div>
</div>
<?php require_once '../footer.php'; ?>

<div class="modal fade" id="cltTable" tabindex="-1" role="dialog" aria-labelledby="cltTable" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cltTableModalLabel">CLT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<?php require_once "../clt/table_clt.php" ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="meiTable" tabindex="-1" role="dialog" aria-labelledby="meiTable" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="meiTableModalLabel">MEI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 	 <?php require_once "../mei/table_mei.php" ?>
      </div>
    </div>
  </div>
</div>

<script>
	function abrirSimulacao() {
		let cod = $("#codSimulacaoClt").val();
		let url_atual = window.location.origin + window.location.pathname;
		window.location.href = url_atual + '?codSimulacaoClt=' + cod
	}

	function abrirLista() {
		let url_atual = window.location.origin;
		window.location.href = url_atual + '/clt/lista_simulacoes.php'
	}

	function resetPage() {
		let url_atual = window.location.origin + window.location.pathname;
		window.location.href = url_atual
	}

	function toMEI() {
		$('#CLT').hide();
		$('#MEI').show();
	}
	
	function toCLT() {
		$('#CLT').show();
		$('#MEI').hide();
	}
</script>