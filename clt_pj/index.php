<?php $page = 'clt_pj'; ?>
<?php 
require_once '../header.php'; 
$form = getFromArray($pjLiquido, 'form');
$faturamento_bruto = getFromArray($form, 'faturamento_bruto', '-');
?>
<style>
	#CLT {
		display: block;
	}

	#PJ {
		display: none;
	}

	#faturamentoBruto {
		display: none;
	}

</style>
<div class="card">
	<div class="card-header text-center" style="font-size: 20pt;">
		CLT x PJ <small style="font-size: 11pt;"><?= date('Y') ?></small>
	</div>
	<div class="card-body">
		
		<form class="forms-sample d-print-none" action="calcular_clt_pj.php" method="post" style="border-bottom: 1px solid;">
			<div id="CLT">
				<div class="row">
					<div class="col-8">
						<?php if($usuarioLogado): ?>
							<a class="btn btn-info" href="lista_simulacoes.php">Últimas Simulações</a>
						<?php endif; ?>
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
				<?php require_once '../clt/form_clt.php' ?>
				<div class="row mb-4">
					<div class="col text-center">
						<a class="btn btn-dark" onclick="toPJ()">Próximo ></a>
					</div>
				</div>
			</div>
			<div id="PJ">
				<div class="row">
					<div class="col-8"></div>
					<div class="col-2 mt-1">
						<b>COD PJ</b>		
					</div>
					<div class="col-2">
						<div class="form-group text-left">
							<input id="codSimulacaoClt" class="form-control" type="number" name="codSimulacaoPj" value="<?= $codSimulacaoPj ?>" readonly>
						</div>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col">
						<h4>PJ</h4>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-2">
						<div class="mt-2">
							<h6>Faturamento Bruto</h6>
						</div>
					</div>
					<div class="col-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text">R$</div>
							</div>
							<input class="form-control" name="faturamento_bruto" value="<?= $faturamento_bruto ?>" readonly>
						</div>
					</div>
				</div>
				<?php require_once '../pj/form_pj.php' ?>
				<div class="row mb-4">
					<div class="col text-center">
						<a class="btn btn-dark" onclick="toCLT()">< Voltar</a>
						<button type="submit" class="btn btn-primary">Calcular</button>
					</div>
				</div>
			</div>
			
			
		</form>
		<div id="resultCltPj">
			<div class="row">
				<div class="col mb-3">
					<span  style="width:100%" class="btn btn-success" data-toggle="modal" data-target="#cltTable">CLT</span>
				</div>
				<div class="col mb-3">
					<span  style="width:100%" class="btn btn-info" data-toggle="modal" data-target="#pjTable">PJ</span>
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

<div class="modal fade" id="pjTable" tabindex="-1" role="dialog" aria-labelledby="pjTable" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pjTableModalLabel">PJ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 	 <?php require_once "../pj/table_pj.php" ?>
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

	function toPJ() {
		$('#CLT').hide();
		$('#PJ').show();
	}
	
	function toCLT() {
		$('#CLT').show();
		$('#PJ').hide();
	}
</script>