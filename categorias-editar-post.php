<?php
    require_once 'global.php';

    try{
        $categoria = new Categoria($_POST['id'], $_POST['nome']);
        $categoria->atualizar();
        header('Location: categorias.php');
        
    }catch(Exception $e) {
        Erro::trataErro($e);

    }
    