<?php require_once '../shared.php'; ?>
<?php
$form = getFromArray($jcResult, 'form');
$valor_inicial = getFromArray($form, 'valor_inicial', '0,00');
$aporte = getFromArray($form, 'aporte', '0,00');
$porcentagem = getFromArray($form, 'porcentagem', '0');
$corretagem = getFromArray($form, 'corretagem', '0');
$retirada = getFromArray($form, 'retirada', '0');
$periodo = getFromArray($form, 'periodo', '0');
?>
<div class="form-group row" id="faturamentoBruto">
	<div class="col-2">
		<div class="mt-2">
			<h6>Valor Inicial</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">R$</div>
			</div>
			<input class="form-control money" name="valor_inicial" value="<?= $valor_inicial ?>">
		</div>
	</div>
</div>
<div class="form-group row" id="faturamentoBruto">
	<div class="col-2">
		<div class="mt-2">
			<h6>Aportes</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">R$</div>
			</div>
			<input class="form-control money" name="aporte" value="<?= $aporte ?>">
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="">
			<h6>Taxa</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<input class="form-control percent" name="porcentagem" value="<?= $porcentagem ?>">
			<div class="input-group-append">
				<div class="input-group-text">%</div>
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="mt-2">
			<h6>Período</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">Qtd</div>
			</div>
			<input class="form-control" type="number" name="periodo" value="<?= $periodo ?>">
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="">
			<h6>Taxa Corretagem</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<input class="form-control percent" name="corretagem" value="<?= $corretagem ?>">
			<div class="input-group-append">
				<div class="input-group-text">%</div>
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="">
			<h6>Retirada</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<input class="form-control percent" name="retirada" value="<?= $retirada ?>">
			<div class="input-group-append">
				<div class="input-group-text">%</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
</script>