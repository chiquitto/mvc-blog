<?php
require './protege.php';
require './config.php';

$q = '';

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
        <h1><i class="fa fa-cubes"></i> Categorias</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Categorias</div>
        <div class="panel-body">
            <form class="form-inline" role="form" method="get" action="">
                <div class="form-group">
                    <label class="sr-only" for="fq">Pesquisa</label>
                    <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa"
                           value="<?php echo $q; ?>">
                </div>
                <button type="submit" class="btn btn-default">Pesquisar</button>
            </form>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th></th>
                <th>Categoria</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{idcategoria}</td>
                    <td>
                        <span class="label label-success">ativo</span>
                        <span class="label label-warning">inativo</span>
                    </td>
                    <td>{categoria}</td>
                    <td>
                        <a href="categorias-editar.php?idcategoria={idcategoria}"
                           title="Editar produto"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="categorias-apagar.php?idcategoria={idcategoria}"
                           title="Remover categoria"><i class="fa fa-times fa-lg"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>