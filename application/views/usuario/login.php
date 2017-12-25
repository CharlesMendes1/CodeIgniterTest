<html lang="en">
    <head>
        <link rel="stylesheet" href="<?= base_url("/css/bootstrap.css") ?>">
    </head>
    <body>	
		<div class="container">
			  <div class="alert-danger"><?php echo validation_errors()?></div>
			<?php
		
			//retorna o que foi preenchido no campo
				$email = set_value('email')? set_value('email') : '';

			echo form_open("usuario/entrar");

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