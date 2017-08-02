<?php
require './protege.php';
require './config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo TITLE; ?></title>

    <?php include PATH . '/cabecalho.php'; ?>
</head>
<body>

<?php include PATH . '/nav.php'; ?>

<div class="container">

    <div class="jumbotron">
        <div class="container">
            <h1><?php echo TITLE; ?></h1>
            <p>Bem vindo {{NOME}}</p>
            <p>
            <div class="btn-group">
                <a class="btn btn-primary btn-lg" role="button" href="postagens.php">
                    <i class="fa fa-list fa-lg"></i> Postagens
                </a>
            </div>

            <div class="btn-group">
                <a class="btn btn-primary btn-lg" role="button" href="categorias.php">
                    <i class="fa fa-cubes fa-lg"></i> Categorias
                </a>
            </div>

            <div class="btn-group">
                <a class="btn btn-primary btn-lg" role="button" href="autores.php">
                    <i class="fa fa-user-secret fa-lg"></i> Autores
                </a>
            </div>

            <div class="btn-group">
                <a class="btn btn-primary btn-lg" role="button" href="usuarios.php">
                    <i class="fa fa-users fa-lg"></i> Usuários
                </a>
            </div>

            </p>
        </div>
    </div>

</div>

<?php include PATH . '/rodape.php'; ?>
</body>
</html>
