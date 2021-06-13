<?php $page = 'jc'; ?>
<?php require_once '../header.php'; ?>

<div class="card">
	<div class="card-header text-center" style="font-size: 20pt;">
		Juros Compostos <small style="font-size: 11pt;"><?= date('Y') ?></small>
	</div>
	<div class="card-body">
		
		<form class="forms-sample d-print-none" action="calcular_jc.php" method="post" style="border-bottom: 1px solid;">
			<div class="row">
				<div class="col-9">
					<?php if($usuarioLogado): ?>
						<a class="btn btn-info" href="lista_simulacoes.php">Últimas Simulações</a>
					<?php endif; ?>
				</div>
				<div class="col-1 mt-1">
					<b>COD</b>		
				</div>
				<div class="col-2">
					<div class="form-group text-left">
						<input id="codSimulacaoJc" class="form-control" type="number" name="codSimulacaoJc" value="<?= $codSimulacaoJc?>" readonly>
					</div>
				</div>
			</div>
			<h4 class="card-title text-left mb-5 d-print-none">Formulário</h4>
			<?php require_once 'form_jc.php' ?>
			<div class="form-group text-left mt-5">
				<button type="submit" class="btn btn-primary">Calcular</button>
				<a href="resetar.php" class="btn btn-danger">Limpar</a>
			</div>
		</form>
		<br><br>
		<?php require_once "table_jc.php" ?>
	</div>
</div>
<?php require_once '../footer.php'; ?>

<script>

	function resetPage() {
		let url_atual = window.location.origin + window.location.pathname;
		window.location.href = url_atual
	}
</script>