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
        <h1><i class="fa fa-users"></i> Usuários</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Usuários</div>
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
                <th>Cidade</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $con = Conexao::getConexao();

            $sql = "Select
              u.idusuario,
              u.nome,
              c.cidade,
              c.uf
            From usuario u
            Inner Join cidade c
              On c.idcidade = u.idcidade";
            $stmt = $con->query($sql);
            while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $usuario['idusuario']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['cidade']; ?>/<?php echo $usuario['uf']; ?></td>
                    <td>
                        <a href="usuarios-editar.php?idusuario=<?php echo $usuario['idusuario']; ?>"
                           title="Editar usuário"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="usuarios-apagar.php?idusuario=<?php echo $usuario['idusuario']; ?>"
                           title="Remover usuário"><i class="fa fa-times fa-lg"></i></a>
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