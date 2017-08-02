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
        <h1><i class="fa fa-user-secret"></i> Cadastrar autor</h1>
    </div>

    <?php if ($msg) {
        msgHtml($msg);
    } ?>

    <form role="form" method="post" action="categorias-cadastrar.php">

        <div class="form-group">
            <label for="fnome">Nome</label>
            <input type="text" class="form-control" id="fnome" name="nome" placeholder="Nome completo"
                   value="">
        </div>

        <div class="form-group">
            <label for="flogin">Login</label>
            <input type="text" class="form-control" id="flogin" name="login" placeholder="Login de acesso"
                   value="">
        </div>

        <div class="form-group">
            <label for="fsenha">Senha</label>
            <input type="password" class="form-control" id="fsenha" name="senha"
                   value="">
        </div>

        <div class="form-group">
            <label for="fsenha2">Confirme a senha</label>
            <input type="password" class="form-control" id="fsenha2" name="senha2"
                   value="">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>