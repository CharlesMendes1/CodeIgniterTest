<html lang="en">
    <head>
        <link rel="stylesheet" href="<?= base_url('css/bootstrap.css') ?>">
    </head>
    <body>
        <div class="container">
    <?php if($this->session->userdata("usuario_logado")):?>  
        
            <h1> Produtos</h1>

                <?php if($this->session->userdata('mensagem') && $this->session->userdata('usuario_logado') ):?>
                        <p class="alert-success"><?php echo $_SESSION['mensagem'];?></p>
                <?php endif?>

            <table class="table">
                <?php foreach($produtos as $produto) : ?>
                    <tr>
                        <td><?=$produto["nome"] ?></td>
                        <td><?=$produto["preco"] ?></td>
                    </tr>
                <?php endforeach ?>
            </table>     

            <?php if($this->session->userdata("usuario_logado")) : ?>
                
              
                 <a class="btn btn-primary" href="../usuario/deslogar">Logout</a>
                
            <?php endif ;?>   
        </div>
    <?php else:?>  
          <h3 class="alert-danger">Não podemos mostrar a lista de produtos, pois vocẽ não esta logado</h3> 
             <?= anchor('produtos/novo','cadastrar produto', array("class" => "btn btn-primary"))?> 
            <?= anchor('usuario/cadastrar','cadastrar usuario', array("class" => "btn btn-primary"))?>
            <?= anchor('produtos/listar','lista produto', array("class" => "btn btn-primary"))?>
            <?= anchor('produtos/adiciona','Novo produto', array("class" => "btn btn-primary"))?>
            <?= anchor('usuario/logar','Logar', array("class" => "btn btn-primary"))?>
    <?php endif;?>
    </body>
</html>