<?php 
require_once 'cabecalho.php';
require_once 'global.php';

try {
    $categoria = new Categoria($_GET['id']);
    $categoria->buscarProdutos();
    $listaProdutos = $categoria->produtos;
    //var_dump($listaProdutos);

} catch (Exception $e) {
    Erro::trataErro($e);
}
?>
<div class="row">
    <div class="col-md-12">
        <h2>Detalhe da Categoria</h2>
    </div>
</div>

<dl>
    <dt>ID</dt>
    <dd><?=$categoria->id ?></dd>
    <dt>Nome</dt>
    <dd><?=$categoria->nome ?></dd>
    <dt>Produtos</dt>
        <?php if (count($listaProdutos) > 0): ?>
            <dd>
                <ul>
                    <?php foreach ($listaProdutos as $linha): ?>
                    <li><a href="/produtos-editar.php?id=<?=$linha['id']?>"><?=$linha['nome']?></a></li>
                    <?php endforeach ?>
                </ul>
            </dd>
        <?php else: ?>
            <P>Nenhum produto cadastrado.</p>
        <?php endif ?>
</dl>
<?php require_once 'rodape.php' ?>
