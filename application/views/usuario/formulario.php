<html lang="en">
    <head>
        <link rel="stylesheet" href="<?= base_url("/css/bootstrap.css") ?>">
    </head>
    <body>
		
		<div class="container">
	            <div class="alert-danger"><?php echo validation_errors()?></div>
			<h1>Cadastrar novo usuario</h1>  
				<?php

				//retorna o que foi preenchido no campo
				$usuario = set_value('nome')? set_value('nome') : '';
				$email = set_value('email')? set_value('email') : '';

				// usuario/novo - chamando controller/funcao
				 echo form_open("usuario/adiciona");
				 				   //Nome for="nome"
				    echo form_label("Nome: ", "nome");    
				    echo form_input(array(
				        "name" => "nome",
				        "id" => "nome",
				        "value" => "$usuario",
				        "class" => "form-control",
				        "maxlength" => "255"
				    ));

				    echo form_label("Email: ", "email");
				    echo form_input(array(
				        "name" => "email",
				        "id" => "email",
				        "value" => "$email",
				        "class" => "form-control",
				        "maxlength" => "255"
				    ));
				   

				    echo form_label("Senha: ", "senha");
					echo form_password(array(
					    "name" => "senha",
					    "id" => "senha",
					    "class" => "form-control",
					    "maxlength" => "255"
					));

					echo form_label("Senha de confirmação: ", "senhaconf");
					echo form_password(array(
					    "name" => "senhaconf",
					    "id" => "senhaconf",
					    "class" => "form-control",
					    "maxlength" => "255"
					));
					

					echo form_button(array(
				    "class" => "btn btn-primary",
				    "content" => "Cadastrar",
				    "type" => "submit"
					));
				   echo form_close();
				?>
			
		</div>
	</body>
</html>