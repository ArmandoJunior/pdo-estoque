<?php
    require_once 'global.php';

    try{
        $categoria = new Categoria(0, $_POST['nome']);
        $categoria->inserir();
        header('Location: categorias.php');

    }catch(Exception $e){
        Erro::trataErro($e);
        
    }
    

    