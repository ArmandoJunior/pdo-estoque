<?php

require_once 'global.php';

try {

    $produto = new Produto($_POST['id']);
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco = $_POST['preco'];
    $produto->quantidade = $_POST['quantidade'];
    $produto->categoria_id = $_POST['categoria_id'];
    $produto->atualizar();

    //print_r($produto);
    
    header('Location: produtos.php');

} catch (Exception $e) {
    Erro::pegaErro($e);
}