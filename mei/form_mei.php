<?php require_once '../shared.php'; ?>
<?php
$form = getFromArray($meiLiquido, 'form');
$faturamento_bruto = getFromArray($form, 'faturamento_bruto', '0,00');
$das = getFromArray($form, 'das', '0,00');
$descontosMEI = getFromArray($form, 'descontosMEI', array());
$beneficiosMEI = getFromArray($form, 'beneficiosMEI', array());
?>
<div class="form-group row" id="faturamentoBruto">
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
			<input class="form-control money" name="faturamento_bruto" value="<?= $faturamento_bruto ?>">
		</div>
	</div>
	<div class="col-2 mt-2">
		<?php if(moneyToNumber($faturamento_bruto) > 6750): ?>
			<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true" data-toggle="tooltip"
			data-html="true" data-placement="right" 
			title="Faturamento Bruto maior que o média mensal máxima. <br>
			MEI max anual: <br>R$ 81.000,00 <br> MEI max média mensal: <br><b>R$ 6.750,00</b>"></i>
		<?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="col">
		<h5 class="text-success">Benefícios
		</h5>
	</div>
	<div class="col">
		<h5 class="text-danger">Descontos
		</h5>
	</div>
</div>

<div class="divisoria"></div>
<div class="row">
	<div class="col">
		<div id="beneficiosContainerMEI">
			<?php foreach ($beneficiosMEI as $index => $beneficio) : ?>
				<?php if ($beneficio['valor'] != 0 && $beneficio['valor'] != "") : ?>
					<div class="form-group row" id="beneficioMEI<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="beneficiosMEI[<?= $index ?>][descricao]" value="<?= $beneficio['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="beneficiosMEI[<?= $index ?>][valor]" value="<?= $beneficio['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeBeneficioMEI(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-success" onclick="addBeneficioMEI()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>DAS MEI</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="das" value="<?= $das ?>">
				</div>
			</div>
		</div>
		<div id="descontosContainerMEI">
			<?php foreach ($descontosMEI as $index => $desconto) : ?>
				<?php if ($desconto['valor'] != 0 && $desconto['valor'] != "") : ?>
					<div class="form-group row" id="descontoMEI<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="descontosMEI[<?= $index ?>][descricao]" value="<?= $desconto['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="descontosMEI[<?= $index ?>][valor]" value="<?= $desconto['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeDescontoMEI(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-warning" onclick="addDescontoMEI()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
</div>



<div class="divisoria"></div>


<script type="text/javascript">
	var beneficioIndexMEI = <?= count($beneficiosMEI) ?>;
	var descontoIndexMEI = <?= count($descontosMEI) ?>;

	function inputBeneficioMEI() {
		beneficioIndexMEI++;
		return '<div class="form-group row" id="beneficioMEI' + beneficioIndexMEI + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="beneficiosMEI[' + beneficioIndexMEI + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="beneficiosMEI[' + beneficioIndexMEI + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeBeneficioMEI(' + beneficioIndexMEI + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addBeneficioMEI() {
		$("#beneficiosContainerMEI").append(inputBeneficioMEI())
		setMask();
	}

	function removeBeneficioMEI(index) {
		$("#beneficioMEI" + index).remove()
	}

	function inputDescontoMEI() {
		descontoIndexMEI++;
		return '<div class="form-group row" id="descontoMEI' + descontoIndexMEI + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="descontosMEI[' + descontoIndexMEI + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="descontosMEI[' + descontoIndexMEI + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeDescontoMEI(' + descontoIndexMEI + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addDescontoMEI() {
		$("#descontosContainerMEI").append(inputDescontoMEI())
		setMask();
	}

	function removeDescontoMEI(index) {
		$("#descontoMEI" + index).remove()
	}
</script>