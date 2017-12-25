<html lang="pt">
    <head>
        <link rel="stylesheet" href="<?= base_url("/css/bootstrap.css") ?>">
    </head>
    <body>
    	<?php if(isset($_SESSION['mensagemSucesso'])):?>
    		<div class="alert-success"><?php echo $_SESSION['mensagemSucesso']?></div>
    	<?php endif; if(isset($_SESSION['mensagemErro'])):?>
    		<div class="alert-danger"><?php echo $_SESSION['mensagemErro']?></div>
		<?php endif;?>
		<div class="container">
			<div class="alert-danger"><?php echo validation_errors()?></div>
			
