<?php require_once '../shared.php'; ?>
<?php
$form = getFromArray($pjLiquido, 'form');
$faturamento_bruto = getFromArray($form, 'faturamento_bruto', '0,00');
$certificado_digital = getFromArray($form, 'certificado_digital', '0,00');
$contador = getFromArray($form, 'contador', '0,00');
$plano_saude = getFromArray($form, 'plano_saude', '0,00');
$plano_odontologico = getFromArray($form, 'plano_odontologico', '0,00');
$aliquota_simples = getFromArray($form, 'aliquota_simples', '0');
$descontosPJ = getFromArray($form, 'descontosPJ', array());
$beneficiosPJ = getFromArray($form, 'beneficiosPJ', array());
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
		<div id="beneficiosContainerPJ">
			<?php foreach ($beneficiosPJ as $index => $beneficio) : ?>
				<?php if ($beneficio['valor'] != 0 && $beneficio['valor'] != "") : ?>
					<div class="form-group row" id="beneficioPJ<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="beneficiosPJ[<?= $index ?>][descricao]" value="<?= $beneficio['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="beneficiosPJ[<?= $index ?>][valor]" value="<?= $beneficio['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeBeneficioPJ(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-success" onclick="addBeneficioPJ()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="form-group row">
			<div class="col-4">
				<div class="">
					<h6>Certificado Digital (Valor Mensal)</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="certificado_digital" value="<?= $certificado_digital ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Contador</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="contador" value="<?= $contador ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Plano de Saúde</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="plano_saude" value="<?= $plano_saude ?>">
				</div>
			</div>	
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Plano Odontológico</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="plano_odontologico" value="<?= $plano_odontologico ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="">
					<h6>Alíquota Simples Nacional</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<input class="form-control percent" name="aliquota_simples" value="<?= $aliquota_simples ?>">
					<div class="input-group-append">
						<div class="input-group-text">%</div>
					</div>
				</div>
			</div>
		</div>
		<div id="descontosContainerPJ">
			<?php foreach ($descontosPJ as $index => $desconto) : ?>
				<?php if ($desconto['valor'] != 0 && $desconto['valor'] != "") : ?>
					<div class="form-group row" id="descontoPJ<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="descontosPJ[<?= $index ?>][descricao]" value="<?= $desconto['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="descontosPJ[<?= $index ?>][valor]" value="<?= $desconto['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeDescontoPJ(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-warning" onclick="addDescontoPJ()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
</div>



<div class="divisoria"></div>


<script type="text/javascript">
	var beneficioIndexPJ = <?= count($beneficiosPJ) ?>;
	var descontoIndexPJ = <?= count($descontosPJ) ?>;

	function inputBeneficioPJ() {
		beneficioIndexPJ++;
		return '<div class="form-group row" id="beneficioPJ' + beneficioIndexPJ + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="beneficiosPJ[' + beneficioIndexPJ + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="beneficiosPJ[' + beneficioIndexPJ + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeBeneficioPJ(' + beneficioIndexPJ + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addBeneficioPJ() {
		$("#beneficiosContainerPJ").append(inputBeneficioPJ())
		setMask();
	}

	function removeBeneficioPJ(index) {
		$("#beneficioPJ" + index).remove()
	}

	function inputDescontoPJ() {
		descontoIndexPJ++;
		return '<div class="form-group row" id="descontoPJ' + descontoIndexPJ + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="descontosPJ[' + descontoIndexPJ + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="descontosPJ[' + descontoIndexPJ + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeDescontoPJ(' + descontoIndexPJ + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addDescontoPJ() {
		$("#descontosContainerPJ").append(inputDescontoPJ())
		setMask();
	}

	function removeDescontoPJ(index) {
		$("#descontoPJ" + index).remove()
	}
</script>