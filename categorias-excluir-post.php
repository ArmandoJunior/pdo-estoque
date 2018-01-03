<?php
    require_once 'cabecalho.php';
    require_once 'global.php';

    try{
        $id = $_GET['id'];
        $qtdeProdutos = Produto::contarProdutos($id);

        //print_r($qtdeProdutos['valor']);

        if ($qtdeProdutos['valor'] == 0) {    
            $categoria = new Categoria($id);
            $categoria->excluir();

            header('Location: categorias.php');

        } else {
            $categoria = new Categoria($id); ?>
            <h4 class="text-danger">A categoria
            <b><a class="text-danger" href="/categorias-detalhe.php?id=<?= $categoria->id?>" class="btn btn-link"><?= $categoria->nome?>
            </a></b>contém produtos cadastrados e não pode ser excluida. -<a href="/categorias.php" class="btn btn-link">voltar</a></h4> 
        <?php
        }

        
    }catch(Exception $e) {
        Erro::trataErro($e);

    }

    require_once 'rodape.php';
    ?>