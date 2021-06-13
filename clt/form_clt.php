<?php require_once '../shared.php'; ?>
<?php
$formCLT = getFromArray($cltLiquido, 'form');
$salario_bruto = getFromArray($formCLT, 'salario_bruto', '0,00');
$numero_dependentes = getFromArray($formCLT, 'numero_dependentes', '0');
$valor_pensao = getFromArray($formCLT, 'valor_pensao', '0,00');
$auxilio_alimentacao = getFromArray($formCLT, 'auxilio_alimentacao', '0,00');
$auxilio_refeicao = getFromArray($formCLT, 'auxilio_refeicao', '0,00');
$desconto_alimentacao = getFromArray($formCLT, 'desconto_alimentacao', '0,00');
$desconto_refeicao = getFromArray($formCLT, 'desconto_refeicao', '0,00');
$descontosCLT = getFromArray($formCLT, 'descontosCLT', array());
$beneficiosCLT = getFromArray($formCLT, 'beneficiosCLT', array());
$auxilioTransporteCheck = getFromArray($formCLT, 'auxilio_transporte_check', false);
$sindicato_check = getFromArray($formCLT, 'sindicato_check', false);
$auxilioTransporte = getFromArray($formCLT, 'auxilio_transporte', '0,00');
$plr = getFromArray($formCLT, 'plr', '0,00');
?>
<div class="form-group row" id="salarioBruto">
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
			<input class="form-control money" name="salario_bruto" value="<?= $salario_bruto ?>">
		</div>
	</div>
	<div class="col-2 mt-2">
		<?php if(moneyToNumber($salario_bruto) >0 && moneyToNumber($salario_bruto) < 1100): ?>
		<i class="fa fa-exclamation-triangle text-danger" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="right" 
			title="Salário menor que o <b>salário mínimo</b>: R$ 1.100,00"></i>
		<?php endif; ?>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="mt-2">
			<h6>Nº Dependentes</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">Qtd</div>
			</div>
			<input class="form-control" type="number" name="numero_dependentes" value="<?= $numero_dependentes ?>">
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-2">
		<div class="mt-2">
			<h6>Pensão Alimentícia</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text">R$</div>
			</div>
			<input class="form-control money" name="valor_pensao" value="<?= $valor_pensao ?>">
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<h5 class="text-success">Benefícios
			<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="right" 
			title="Benefícios que <b>não</b> irão impactar no cálculo do Imposto de Renda. 
			Ex: Alimentação, Refeição, Auxílio Transporte Auxílio Internet!"></i>
		</h5>
	</div>
	<div class="col">
		<h5 class="text-danger">Descontos
			<i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="right" 
			title="Outros Descontos que <b>não</b> irão impactar no cálculo do Imposto de Renda. Ex: Plano de Saúde, Alimentação,
			6% do Auxílio Transporte!"></i>
		</h5>
	</div>
</div>

<div class="divisoria"></div>
<div class="row">
	<div class="col">
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Auxílio Transporte</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="auxilio_transporte" value="<?= $auxilioTransporte ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Auxílio Alimentação</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="auxilio_alimentacao" value="<?= $auxilio_alimentacao ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Auxílio Refeição</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="auxilio_refeicao" value="<?= $auxilio_refeicao ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>PLR (ANUAL)</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="plr" value="<?= $plr ?>">
				</div>
			</div>
		</div>
		<div id="beneficiosContainerCLT">
			<?php foreach ($beneficiosCLT as $index => $beneficio) : ?>
				<?php if ($beneficio['valor'] != 0 && $beneficio['valor'] != "") : ?>
					<div class="form-group row" id="beneficioCLT<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="beneficiosCLT[<?= $index ?>][descricao]" value="<?= $beneficio['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="beneficiosCLT[<?= $index ?>][valor]" value="<?= $beneficio['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeBeneficioCLT(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-success" onclick="addBeneficioCLT()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="form-group row">
			<div class="col-4">
				<div class="">
					<h6>Auxílio Transporte (6% CLT)</h6>
				</div>
			</div>
			<div class="col-6">
				<input class="" type="checkbox" name="auxilio_transporte_check" value="true" <?= $auxilioTransporteCheck ? 'checked' : '' ?>>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="">
					<h6>Sindicato Anual <br>1/30 Salário</h6>
				</div>
			</div>
			<div class="col-6">
				<input class="" type="checkbox" name="sindicato_check" value="true" <?= $sindicato_check ? 'checked' : '' ?>>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Alimentação</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="desconto_alimentacao" value="<?= $desconto_alimentacao ?>">
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-4">
				<div class="mt-2">
					<h6>Refeição</h6>
				</div>
			</div>
			<div class="col-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">R$</div>
					</div>
					<input class="form-control money" name="desconto_refeicao" value="<?= $desconto_refeicao ?>">
				</div>
			</div>
		</div>
		<div id="descontosContainerCLT">
			<?php foreach ($descontosCLT as $index => $desconto) : ?>
				<?php if ($desconto['valor'] != 0 && $desconto['valor'] != "") : ?>
					<div class="form-group row" id="descontoCLT<?= $index ?>">
						<div class="col-4">
							<div class="">
								<input class="form-control" placeholder="Descrição" name="descontosCLT[<?= $index ?>][descricao]" value="<?= $desconto['descricao'] ?>">
							</div>
						</div>
						<div class="col-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">R$</div>
								</div>
								<input class="form-control money" name="descontosCLT[<?= $index ?>][valor]" value="<?= $desconto['valor'] ?>">
							</div>
						</div>
						<div class="col-2 mt-1">
							<a class="btn btn-danger" onclick="removeDescontoCLT(<?= $index ?>)"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<div class="form-group row">
			<div class="col-2">
				<a class="btn btn-warning" onclick="addDescontoCLT()"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</div>
</div>


<div class="divisoria"></div>


<script type="text/javascript">
	var beneficioIndexCLT = <?= count($beneficiosCLT) ?>;
	var descontoIndexCLT = <?= count($descontosCLT) ?>;

	function inputBeneficioCLT() {
		beneficioIndexCLT++;
		return '<div class="form-group row" id="beneficioCLT' + beneficioIndexCLT + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="beneficiosCLT[' + beneficioIndexCLT + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="beneficiosCLT[' + beneficioIndexCLT + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeBeneficioCLT(' + beneficioIndexCLT + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addBeneficioCLT() {
		$("#beneficiosContainerCLT").append(inputBeneficioCLT())
		setMask();
	}

	function removeBeneficioCLT(index) {
		$("#beneficioCLT" + index).remove()
	}

	function inputDescontoCLT() {
		descontoIndexCLT++;
		return '<div class="form-group row" id="descontoCLT' + descontoIndexCLT + '">' +
			'<div class="col-4">' +
			'<div class="">' +
			'<input class="form-control" placeholder="Descrição" name="descontosCLT[' + descontoIndexCLT + '][descricao]">' +
			'</div>' +
			'</div>' +
			'<div class="col-6">' +
			'<div class="input-group">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">R$</div>' +
			'</div>' +
			'<input class="form-control money" name="descontosCLT[' + descontoIndexCLT + '][valor]" required>' +
			'</div>' +
			'</div>' +
			'<div class="col-2 mt-1">' +
			'<a class="btn btn-danger" onclick="removeDescontoCLT(' + descontoIndexCLT + ')"><i class="fa fa-times"></i></a>' +
			'</div>' +
			'</div>';
	}

	function addDescontoCLT() {
		$("#descontosContainerCLT").append(inputDescontoCLT())
		setMask();
	}

	function removeDescontoCLT(index) {
		$("#descontoCLT" + index).remove()
	}
</script>