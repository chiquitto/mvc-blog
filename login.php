<?php
require './protege.php';
require './config.php';

if ($_POST) {

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include PATH . '/cabecalho.php'; ?>

    <title><?php echo TITLE; ?></title>
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .container {
            max-width: 330px;
        }

        form {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-xs-12">

            <h2 class="form-signin-heading">Faça seu login</h2>

            <form class="form-signin" role="form" method="post" action="login.php">
                <div class="form-group">
                    <label for="femail" class="sr-only">Email: </label>
                    <input type="email" class="form-control" id="femail" name="email" placeholder="Endereço de e-mail">
                </div>

                <div class="form-group">
                    <label for="fsenha" class="sr-only">Senha: </label>
                    <input type="password" class="form-control" id="fsenha" name="senha" placeholder="Senha">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Fazer login</button>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-info" role="alert">
                <strong>Email/Senha padrão:</strong> admin/admin
            </div>
        </div>
    </div>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>