 </main>			
	  	<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.0.js'></script>
		<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?=$base?>/js/mask.money.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    </body>

    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalAlertTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalAlertTitle">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	    </div>
	  </div>
	</div>

    <script type="text/javascript">
    	$(document).ready(function(){
			setMask();
			$('[data-toggle="tooltip"]').tooltip();

		});

		function setMask() {
			
			$("#phone").inputmask({
				mask: '999 999 9999',
				placeholder: ' ',
				showMaskOnHover: false,
				showMaskOnFocus: false,
				onBeforePaste: function (pastedValue, opts) {
					var processedValue = pastedValue;
					return processedValue;
				}
			});

	     	$('.percent').mask('##0,00', {reverse: true});

			$('.hora').mask('99:99', {reverse: true});

			$(".money").maskMoney({
         		prefix: "",
         		decimal: ",",
         		thousands: ".",
         		allowZero: true
	     	});
		}

		function moneyToFloat(valor) {
			if(valor != undefined && valor != null) {
				var number = parseFloat(valor.replace(/(,|\.)([0-9]{3})/g,'$2').replace(/(,|\.)/,'.'));
				return Number.isNaN(number) ? 0 : number
			}
			return ''
		}

		function floatToMoney(number, options = {}) {
		    const { moneySign = true } = options;

		    if(Number.isNaN(number) || !number) return "";

		    if(typeof number === "string") { // n1
		        number = Number(number);
		    }

		    let res;

		    const config = moneySign ? {style: 'currency', currency: 'BRL'} : {minimumFractionDigits: 2};

		    moneySign
		    ? res = number.toLocaleString('pt-BR', config)
		    : res = number.toLocaleString('pt-BR', config)

		    const needComma = number => number <= 1000;
		    if(needComma(number)) {
		        res = res.toString().replace(".", ",");
		    }

		    return res; // n2
		}

		var floatFloor = function(numero, casasDecimais) {
		  casasDecimais = typeof casasDecimais !== 'undefined' ?  casasDecimais : 2;
		  return +(Math.floor(numero + ('e+' + casasDecimais)) + ('e-' + casasDecimais));
		};

		var floatRound = function(numero, casasDecimais) {
		  casasDecimais = typeof casasDecimais !== 'undefined' ?  casasDecimais : 2;
		  return +(Math.round(numero + ('e+' + casasDecimais)) + ('e-' + casasDecimais));
		};

		function showMessage(title, msg) {
			$('#modalAlertTitle').text(title);
			$('#modalAlert .modal-body').text(msg)
			$('#modalAlert').modal('show')
		}

		function successMessage(msg) {
			$('#modalAlert').removeClass("modal-danger").addClass("modal-success")
			showMessage("Sucesso!", msg)
		}

		function errorMessage(msg) {
			$('#modalAlert').removeClass("modal-success").addClass("modal-danger")
			showMessage("Error!", msg)
		}

    </script>
</html>