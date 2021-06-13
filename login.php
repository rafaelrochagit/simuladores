<?php $page = 'home'; ?>
<?php require_once 'header.php'; ?>

<form class="forms-sample d-print-none" action="logar.php" method="post">
    <div class="form-group row">
        <div class="col-2">
            <div class="mt-2">
                <h6>Chave Acesso</h6>
            </div>
        </div>
        <div class="col-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">#</div>
                </div>
                <input class="form-control" type="text" name="chave_acesso">
            </div>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-dark">Logar</button>
        </div>
    </div>
</form>
<?php require_once 'footer.php'; ?>