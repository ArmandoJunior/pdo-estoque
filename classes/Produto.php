<?php

    class Produto
    {
        public $id;
        public $nome;
        public $descricao;
        public $preco;
        public $quantidade;
        public $usado = 0;
        public $categoria_id;

        public function __construct($id=false) 
        {
            if ($id) {
                $this->id = $id;
                $this->buscar();
            }
        }

        public function buscar() 
        {
            $query = "SELECT id, nome, descricao, preco, quantidade, categoria_id FROM produtos WHERE id = :id";
            $conexao = Conexao::pegarConexao();
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $linha = $stmt->fetch();

            $this->id = $linha['id'];
            $this->nome = $linha['nome'];
            $this->descricao = $linha['descricao'];
            $this->preco = $linha['preco'];
            $this->quantidade = $linha['quantidade'];
            $this->categoria_id = $linha['categoria_id'];

        }

        public static function listar()
        {
            $query = "SELECT p.id, p.nome, p.descricao, p.preco, p.quantidade, p.usado, p.categoria_id, c.nome AS categoria_nome 
                      FROM produtos p
                      INNER JOIN categorias c ON c.id = p.categoria_id";
            $conexao = Conexao::pegarConexao();
            $resultato = $conexao->query($query);
            $lista = $resultato->fetchAll();
            return $lista;
        }

        public static function listarPorCategoria($id)
        {
            //var_dump($id);
            $query = "SELECT id, nome, descricao, preco, quantidade, categoria_id FROM produtos WHERE categoria_id = :id";
            $conexao = Conexao::pegarConexao();
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        
            return $stmt->fetchAll();
        }

        public static function contarProdutos($categoria_id)
        {
            $query = "SELECT count(id) as valor
                      FROM produtos
                      WHERE categoria_id = ".$categoria_id;
            $conexao = Conexao::pegarConexao();
            $resultato = $conexao->query($query);
            $linha = $resultato->fetch();
            return $linha;
        }

        public function inserir()
        {
           $query = "INSERT INTO produtos (nome, descricao, preco, quantidade, categoria_id, usado) 
                     VALUES (:nome, :descricao, :preco, :quantidade, :categoria_id, :usado)";
                    $conexao = Conexao::pegarConexao();
                    $stmt = $conexao->prepare($query);
                    $stmt->bindValue(':nome', $this->nome);
                    $stmt->bindValue(':descricao', $this->descricao);
                    $stmt->bindValue(':preco', $this->preco);
                    $stmt->bindValue(':quantidade', $this->quantidade);
                    $stmt->bindValue(':categoria_id', $this->categoria_id);
                    $stmt->bindValue(':usado', $this->usado);
                    $stmt->execute(); 
        }

        public static function listar2()
        {
            $query = "SELECT p.id, p.nome, p.descricao, p.preco, p.quantidade, p.usado, p.categoria_id, c.nome AS categoria_nome 
                      FROM produtos p
                      LEFT JOIN categorias c ON c.id = p.categoria_id
                      ORDER BY p.nome";
            return Conexao::pegarConexao()->query($query)->fetchAll();
        }

        public function atualizar()
        {
            $query = "UPDATE produtos 
                      SET nome          = :nome, 
                          descricao     = :descricao, 
                          preco         = :preco, 
                          quantidade    = :quantidade, 
                          categoria_id  = :categoria_id
                      WHERE id          = :id";
            $conexao = Conexao::pegarConexao();
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id', $this->id);
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':descricao', $this->descricao);
            $stmt->bindValue(':preco', $this->preco);
            $stmt->bindValue(':quantidade', $this->quantidade);
            $stmt->bindValue(':categoria_id', $this->categoria_id);
            $stmt->execute();
        }

        public function excluir() 
        {
        $query = "DELETE FROM produtos WHERE id = :id";
        $conexao = Conexao::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $this->id);
        $stmt->execute();

        }

    }