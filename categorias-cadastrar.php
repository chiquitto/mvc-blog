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
        <h1><i class="fa fa-cubes"></i> Cadastrar categoria</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="categorias-cadastrar.php">

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <input type="text" class="form-control" id="fcategoria" name="categoria" placeholder="Nome da categoria"
                   value="">
        </div>

        <div class="form-group">
            <label for="fdescricao">Descrição</label>
            <textarea class="form-control" id="fdescricao" name="descricao"></textarea>
        </div>

        <div class="checkbox">
            <label for="fsituacao">
                <input type="checkbox" name="situacao" id="fsituacao" checked> Categoria
                ativa
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>