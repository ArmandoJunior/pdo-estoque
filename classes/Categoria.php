<?php

class Categoria
{

    public $id;
    public $nome;
    public $produtos;

    public function __construct($id=false, $nome=false)
    {
        $return = [
            'status' => false,
            'message' => 'nenhuma parametro enviado'
        ];

        if ($nome) {
            $this->nome = $nome;
            if($id) {
                $this->id = $id;
            }

            $return = ['status' => true];
        } else {
            if($id) {
                $this->id = $id;
                $this->buscar();  

                $return = ['status' => true];
            }
        }
        
        return $return;
    }

    public static function listar()
    {
        //throw new Exception('Erro ao listatr...');
        $query = "SELECT id, nome FROM categorias ORDER BY nome";
        $conexao = Conexao::pegarConexao();
        $resultado = $conexao->query($query);
        //var_dump($resultado);
        $lista = $resultado->fetchAll();
        return $lista;
    }
    
    public function inserir()
    {
        $query = "INSERT INTO categorias (nome) VALUES (:nome)";
        $conexao = Conexao::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->execute();
    }

    public function excluir()
    {
        $query = "DELETE FROM categorias WHERE id = :id";
        $conexao = Conexao::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
    }

    public function atualizar()
    {
        $query = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $conexao = Conexao::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
    }

    public function buscar()
    {
        $query = "SELECT * FROM categorias WHERE id = :id";
        $conexao = Conexao::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();
        $linha = $stmt->fetch();
        $this->nome = $linha['nome'];
        
    }

    public function buscarProdutos()
    {
        $this->produtos = Produto::listarPorCategoria($this->id);
    }
}