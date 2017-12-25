
<?php

    $nome = set_value('nome')? set_value('nome') : '';
    $preco = set_value('preco')? set_value('preco') : '';
    $descricao = set_value('descricao')? set_value('descricao') : '';
   
echo form_open("produtos/novo");

echo form_label("Nome: ", "nome");
echo form_input(array(
    "name" => "nome",
    "class" => "form-control",
    "value" => "$nome",
    "id" => "nome",
    "maxlength" => "255",
));


echo form_label("Preco: ", "preco");
echo form_input(array(
    "name" => "preco",
    "class" => "form-control",
    "value" => "$preco",
    "id" => "preco",
    "maxlength" => "255",
    "type" => "number",
));

echo form_label("Descrição: ", "descricao");
echo form_textarea(array(
    "name" => "descricao",
    "class" => "form-control",
     "value" => "$descricao",
    "id" => "descricao",
));

echo form_button(array(
    "class" => "btn btn-primary",
    "content" => "Cadastrar",
    "type" => "submit"
));




echo form_close();


?>