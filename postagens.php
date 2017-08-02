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
        <h1><i class="fa fa-list"></i> Postagens</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Postagens</div>
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
                <th>Cadastro</th>
                <th>Autor</th>
                <th>Categoria</th>
                <th>Título</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $con = Conexao::getConexao();

            $sql = "Select idpostagem, idcategoria, titulo, datacadastro, idadmin, situacao From postagem";
            $stmt = $con->query($sql);
            while ($postagem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $postagem['idpostagem']; ?></td>
                    <td>
                        <span class="label label-success">ativo</span>
                        <span class="label label-warning">inativo</span>
                    </td>
                    <td><?php echo $postagem['datacadastro']; ?></td>
                    <td><?php echo $postagem['idadmin']; ?></td>
                    <td><?php echo $postagem['idcategoria']; ?></td>
                    <td><?php echo $postagem['titulo']; ?></td>
                    <td>
                        <a href="postagens-editar.php?idpostagem=<?php echo $postagem['idpostagem']; ?>"
                           title="Editar postagem"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="postagens-apagar.php?idpostagem=<?php echo $postagem['idpostagem']; ?>"
                           title="Remover postagem"><i class="fa fa-times fa-lg"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>