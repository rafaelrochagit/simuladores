<?php
$form = getFromArray($pontoResult, 'form');
$meta = getFromArray($form, 'meta', '--:--');
$horas = getFromArray($form, 'horas', array());
$diferencas = getFromArray($pontoResult, 'diferencas', array());
$horaFinal = getFromArray($pontoResult, 'horaFinal', '--:--');
$timeDiferencaAteFinal = getFromArray($pontoResult, 'timeDiferencaAteFinal', '--:--');
$ultimaEntrada = getFromArray($pontoResult, 'ultimaEntrada', '--:--');
$timeTotal = getFromArray($pontoResult, 'timeTotal', '--:--');

?>
<div id="resultJc">
    <div class="row">
        <div class="col">
            <div class="card bg-light mb-3 text-center" style="max-width: 27rem;">
                <div class="card-header">
                    <b>Meta <br> horas a trabalhar</b>
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $meta ?></h4>
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3 text-center" style="max-width: 27rem;">
                <div class="card-header"><b>Horário Saída <br> para cumprir a meta</b></div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                    <h4><?= $horaFinal ?></h4>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Entrada</th>
            <th scope="col">Saída</th>
            <th scope="col">Tempo</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $i = 0; 
            foreach ($horas as $index => $hora) : 
                if($i%2!=0 && isset($horas[$index-1])):
        ?>
                    <tr>
                        <td class="text-success"><?=$horas[$index-1]?></td>
                        <td class="text-danger"><?=$hora ?></td>
                        <td><?=current($diferencas)?></td>
                    </tr>
        <?php 
                next($diferencas);
                endif;
            $i++;
            endforeach; 
        ?>
         <tr>
            <td class="text-success"><?=$ultimaEntrada?></td>
            <td class="text-danger"><?= $horaFinal?></td>
            <td><?=$timeDiferencaAteFinal?></td>
        </tr>
        <tr class="table-black">
            <td>Hora Final para cumprir a meta</td>
            <td class="text-danger"><?= $horaFinal?></td>
            <td><?=$timeTotal?></td>
        </tr>
</table>