<?php require_once '../shared.php'; ?>
<?php
$form = getFromArray($pontoResult, 'form');
$horas = getFromArray($form, 'horas', array());
$meta = getFromArray($form, 'meta', ":");
?>
<div class="form-group row">
	<div class="col-2">
		<div class="mt-2">
			<h6>Meta (h)</h6>
		</div>
	</div>
	<div class="col-3">
		<div class="input-group">
			<input class="form-control hora" name="meta" value="<?= $meta ?>">
		</div>
	</div>
</div>
<div id="horasContainer">
	<?php $i=0; foreach ($horas as $index => $hora) : ?>
		<?php if ($hora != ":" && $hora != "") : ?>
			<div class="form-group row" id="hora<?= $index ?>">
				<div class="col-2">
					<div class="mt-2">
						<?php if($i%2==0): ?>
							<span class="text-success">Entrada</span>
						<?php else: ?>
							<span class="text-danger">Saída</span>
						<?php endif;?>
					</div>
				</div>
				<div class="col-3">
					<div class="input-group">
						<input class="form-control hora" name="horas[<?= $index ?>]" value="<?= $hora ?>">
					</div>
				</div>
				
			</div>
		<?php endif; ?>
	<?php $i++; endforeach; ?>
</div>
<div class="form-group row">
	<div class="col-2">
		<a class="btn btn-warning" onclick="addHora()"><i class="fa fa-plus"></i></a>
	</div>
</div>


<script type="text/javascript">	
	var index = <?= count($horas) ?>;
	var par = index % 2 == 0 ? true : false;
	
	function addHora() {
		$("#horasContainer").append(inputHora())
		setMask();
		verificaSubmit();
	}

	function inputHora() {
		const entrada = '<span class="text-success">Entrada</span>'; 
		const saida = '<span class="text-danger">Saída</span>';
		const horaIndicador = par ? entrada : saida;
		par = !par
		index++
		return '<div class="form-group row" id="hora '+ index + '">'+
				'<div class="col-2">'+
					'<div class="mt-2">'+
					horaIndicador +
					'</div>' +
				'</div>' +
				'<div class="col-3">' +
					'<div class="input-group">' +
						'<input class="form-control hora" name="horas['+ index + ']" value=":">' +
					'</div>' +
				'</div>' +
				
			'</div>';
	}
</script>