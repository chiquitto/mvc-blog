<?php
require './protege.php';
require './config.php';

$msg = array();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo TITLE; ?></title>

    <?php include PATH . '/cabecalho.php'; ?>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <div class="page-header">
        <h1><i class="fa fa-list"></i> Cadastrar postagem</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="postagens-cadastrar.php">

        <div class="form-group">
            <label for="fautor">Autor</label>
            <input type="text" class="form-control" id="fautor" name="autor" disabled
                   value="">
        </div>

        <div class="form-group">
            <label for="fdatacadastro">Data de cadastro</label>
            <input type="text" class="form-control" id="fdatacadastro" name="datacadastro" disabled
                   value="">
        </div>

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <select class="form-control">
                <option value="0">Selecione ...</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ftitulo">Título</label>
            <input type="text" class="form-control" id="ftitulo" name="titulo" placeholder="Título da postagem"
                   value="">
        </div>

        <div class="form-group">
            <label for="ftexto">Texto</label>
            <textarea class="form-control" id="ftexto" name="texto" rows="5"></textarea>
        </div>

        <div class="checkbox">
            <label for="fsituacao">
                <input type="checkbox" name="situacao" id="fsituacao" checked>
                Postagem ativa
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>