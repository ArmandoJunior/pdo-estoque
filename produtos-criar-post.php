<?php

    require_once 'global.php';

    try {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $categoria_id = $_POST['categoria_id'];

        $produto = new Produto();
        
        $produto->nome = $nome;
        $produto->descricao = $descricao;
        $produto->preco = $preco;
        $produto->quantidade = $quantidade;
        $produto->categoria_id = $categoria_id;
        $produto->inserir();

        //var_dump($produto);
        header('Location: produtos.php');

    } catch (Exception $e) {
        Erro::trataErro();
    }