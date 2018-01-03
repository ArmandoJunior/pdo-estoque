<?php

class Conexao 
{
    public static function pegarConexao()
    {
        //$conexao = new PDO('mysql:host=localhost;dbname=loja','root','jr120777');
        $conexao = new PDO(DB_DRIVE . ':host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        return $conexao;
    }


}