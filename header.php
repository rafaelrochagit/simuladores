<?php require_once 'shared.php'; ?>
<html>
    <head>
	 	<title>Simuladores</title>
     	<link rel="shortcut icon" type="image/x-icon" href="<?=$base?>/icone-simulador.png">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
    </head>
    <style type="text/css">
        .menu {
            display: flex;
        }

        .modal-success .modal-content{
        	color: #155724;
		    background-color: #d4edda;
		    border-color: #c3e6cb;
        }

        .modal-success .modal-header {
        	border-bottom: 1px solid #b1dfbb;
        }

        .modal-danger .modal-content {
		    color: #721c24;
		    background-color: #f8d7da;
		    border-color: #f5c6cb;
        }

        .modal-danger .modal-header {
        	border-bottom: 1px solid #b67772e3;
        }
        
        input[readonly] {
        	cursor: not-allowed;
        }

        .media {
    	    border-bottom: 1px solid;
    		padding-bottom: 25px;
    		padding-top: 25px;
        }

        a {
        	cursor: pointer;
        }

		.divisoria {
			border-bottom: 1px #d5d5d5 solid;
			margin-top: 5px;
			margin-bottom: 15px;
		}

		.table-black {
			background-color: #000;
			color:#fff;
		}

		.table th, .table td {
			vertical-align: middle;
		}

		.link {
			cursor: pointer;
		}

		.card-header {
			height: 5vw;
		}

		input[type="checkbox"] {
			width: 30px;
    		height: 35px;
		}

		.container {
			max-width: 95% !important;
		}

    </style>
    <body>
    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		    <a class="navbar-brand" href="<?=$base?>/login.php">
	    		<img src="<?=$base?>/icone-simulador.png" width="30px">
	    	</a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>

		    <div class="collapse navbar-collapse" id="navbarColor01">
		      <ul class="navbar-nav mr-auto">
		        <li class="nav-item <?= $pagina == 'home' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/">Home</a>
		        </li>
				<li class="nav-item <?= $pagina == 'clt' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/clt">CLT</a>
		        </li>
				<li class="nav-item <?= $pagina == 'pj' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/pj">PJ</a>
		        </li>
				<li class="nav-item <?= $pagina == 'mei' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/mei">MEI</a>
		        </li>
				<li class="nav-item <?= $pagina == 'clt_pj' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/clt_pj">CLT x PJ</a>
		        </li>
				<li class="nav-item <?= $pagina == 'pj_clt' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/pj_clt">PJ x CLT</a>
		        </li>
				<li class="nav-item <?= $pagina == 'clt_mei' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/clt_mei">CLT x MEI</a>
		        </li>
				<li class="nav-item <?= $pagina == 'mei_clt' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/mei_clt">MEI x CLT</a>
		        </li>
				<?php if($usuarioLogado): ?>
		        <li class="nav-item <?= $pagina == 'tabelas' ? 'active' : '' ?>">
		          <a class="nav-link" href="<?=$base?>/tabelas.php">Tabelas</a>
		        </li>
				<?php endif; ?>
				<?php if($usuarioLogado): ?>
		        <li class="nav-item">
		          <a class="nav-link" href="<?=$base?>/logout.php">Sair</a>
		        </li>
				<?php endif; ?>
		      </ul>
		    </div>
		</nav>

		<main class="container mt-5">
		<?php if($msg!= null):?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Error!</strong> <?= $msg ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php endif; ?>
		<?php if($msgSuccess!= null):?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Sucesso!</strong> <?= $msgSuccess ?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php endif; ?>