<?php 
require_once 'cabecalho.php';
require_once 'global.php';

try {
$id = $_GET['id'];
$produto = new Produto($id);
$listaCategoria = Categoria::listar();
//print_r($listaCategoria);
}catch (Exception $e) {
    Erros::trataErro($e);
}
?>
<div class="row">
    <div class="col-md-12">
        <h2>Editar Nova Categoria</h2>
    </div>
</div>

<form action="produto-editar-post.php" method="post">
    <input type="hidden" name="id" value="<?=$produto->id ?>"
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" value="<?=$produto->nome ?>" class="form-control" placeholder="Nome do Produto" required>
            </div>
            <div class="form-group">
                <label for="nome">Descrição do Produto</label>
                <input type="text" name="descricao" value="<?=$produto->descricao ?>" class="form-control" placeholder="Descrição do Produto" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço da Produto</label>
                <input type="number" name="preco" value="<?=$produto->preco ?>" step="0.01" min="0" class="form-control" placeholder="Preço do Produto" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade do Produto</label>
                <input type="number" name="quantidade" value="<?=$produto->quantidade ?>" min="0" class="form-control" placeholder="Quantidade do Produto" required>
            </div>
            <div class="form-group">
                <label for="nome">Categoria do Produto</label>
                <select class="form-control" name="categoria_id">
                    <?php 
                        $selected = '';
                        foreach ($listaCategoria as $linha): 
                        if ($linha['id'] == $produto->categoria_id) {
                            $selected = 'selected';
                        }
                        ?>
                        <option <?= $selected ?> value="<?=$linha['id'] ?>" ><?=$linha['nome'] ?></option>
                        <?php $selected = '' ?>
                    <?php endforeach ?>
                </select>
            </div>
            <input type="submit" class="btn btn-success btn-block" value="Salvar">
        </div>
    </div>
</form>

<?php require_once 'rodape.php' ?>
