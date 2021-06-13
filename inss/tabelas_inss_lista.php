<?php $page = 'tabelas'; ?>
<?php require_once '../header.php'; ?>
<?php
	$tabelas = $inss->readTabelas();
?>


	<div class="row mb-3">
		<div class="col">
			<a class="btn btn-primary" href="tabela_inss.php">Voltar</a>
		</div>
	</div>
	<h2 class="text-center">Tabelas INSS</h2>
	<div class="row">
		<div class="col">
			<?php if(count($tabelas) > 0): ?>
			<ul class="list-unstyled">
				<?php foreach($tabelas as $t): ?>
		  		<li class="media">
					<div class="media-body">
						<h5 class="mt-0 mb-1"><?=$t?></h5>
					</div>
					<a class="ml-3" onclick="showTabela('<?=$t?>')">Ver</a>
					<?php if($tabelaNome != $t): ?>
						<a class="ml-3" href="seleciona_tabela.php?tabelaNome=<?=$t?>">Selecionar</a>
						<a class="ml-3" href="delete_tabela.php?tabelaNome=<?=$t?>">Remover</a>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else : ?>
			<h6 class="text-center mt-5">Nenhum resultado encontrado</h6>
			<?php endif; ?>
		</div>
	</div>

<div id="modalTabela" class="modal fade bd-example-modal-lg" tabindex="-1"
 role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="modalTabelaLabel">Large modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col"><h5>Faixa</h5></div>
        	<div class="col"><h5>Piso</h5></div>
        	<div class="col"><h5>Teto</h5></div>
        	<div class="col"><h5>%</h5></div>
        	<div class="col"><h5>Valor Máximo</h5></div>
        </div>
     	<div class="row mt-2">
        	<div class="col"><h6>1ª Faixa Salarial</h6></div>
        	<div class="col">R$ <span id="piso1"></span></div>
        	<div class="col">R$ <span id="teto1"></span></div>
        	<div class="col"><span id="percent1"></span>%</div>
        	<div class="col">R$ <span id="max1"></span></div>
        </div>
        <div class="row mt-2">
        	<div class="col"><h6>2ª Faixa Salarial</h6></div>
        	<div class="col">R$ <span id="piso2"></span></div>
        	<div class="col">R$ <span id="teto2"></span></div>
        	<div class="col"><span id="percent2"></span>%</div>
        	<div class="col">R$ <span id="max2"></span></div>
        </div>
        <div class="row mt-2">
        	<div class="col"><h6>3ª Faixa Salarial</h6></div>
        	<div class="col">R$ <span id="piso3"></span></div>
        	<div class="col">R$ <span id="teto3"></span></div>
        	<div class="col"><span id="percent3"></span>%</div>
        	<div class="col">R$ <span id="max3"></span></div>
        </div>
        <div class="row mt-2">
        	<div class="col"><h6>4ª Faixa Salarial</h6></div>
        	<div class="col">R$ <span id="piso4"></span></div>
        	<div class="col">R$ <span id="teto4"></span></div>
        	<div class="col"><span id="percent4"></span>%</div>
        	<div class="col">R$ <span id="max4"></span></div>
        </div>
        <div class="row mt-2">
        	<div class="col"><h6>Teto</h6></div>
        	<div class="col">-</div>
        	<div class="col">-</div>
        	<div class="col">-</div>
        	<div class="col">R$ <span id="tetoTotal"></span></div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>


<?php require_once '../footer.php'; ?>

<script type="text/javascript">


	function deleteTabela($tabelaNome) {
		$.ajax({
			type: 'POST',
			url: 'delete_tabela.php',
			data: {tabelaNome:$tabelaNome},
			dataType: 'json',
			success: function (tabela) {
				successMessage($tabelaNome + " excluída com sucesso!")
			},
			error : function (err) {
				console.log(err)
				errorMessage("Algo não está certo <br>"+ err);
			} 	
	 	});
	}

	function showTabela($tabelaNome) {
		$.ajax({
			type: 'POST',
			url: 'read_tabela.php',
			data: {tabelaNome:$tabelaNome},
			dataType: 'json',
			success: function (tabela) {
				preencheModal(tabela, 1)
				preencheModal(tabela, 2)
				preencheModal(tabela, 3)
				preencheModal(tabela, 4)
				$("#tetoTotal").text(tabela["teto"])
				$("#modalTabelaLabel").text($tabelaNome)
				$("#modalTabela").modal("show")
			},
			error : function (err) {
				console.log(err)
				errorMessage("Algo não está certo <br>"+ err);
			} 	
	 	});
	}

	function preencheModal(tabela, i) {
		$("#piso"+i).text(tabela['faixa'+i]['piso']);
		$("#teto"+i).text(tabela['faixa'+i]['teto']);
		$("#percent"+i).text(tabela['faixa'+i]['percent']);
		$("#max"+i).text(tabela['faixa'+i]['max']);
	}

</script>
