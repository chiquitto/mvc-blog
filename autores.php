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
        <h1><i class="fa fa-user-secret"></i> Autores</h1>
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
                <th>Nome</th>
                <th>Login</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $con = \App\Conexao::getConexao();

            $sql = "Select idadmin, nome, login From admin";
            $stmt = $con->query($sql);
            while ($admin = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $admin['idadmin']; ?></td>
                    <td><?php echo $admin['nome']; ?></td>
                    <td><?php echo $admin['login']; ?></td>
                    <td>
                        <a href="autores-editar.php?idadmin=<?php echo $admin['idadmin']; ?>"
                           title="Editar produto"><i class="fa fa-edit fa-lg"></i></a>
                        <!--<a href="autores-apagar.php?idadmin=<?php echo $admin['idadmin']; ?>"
                           title="Remover categoria"><i class="fa fa-times fa-lg"></i></a>-->
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