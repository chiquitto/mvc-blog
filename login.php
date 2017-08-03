<?php
require './config.php';

$msg = array();

if ($_POST) {
    $con = \App\Conexao::getConexao();

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "Select idadmin, nome From
    admin Where (login='$login') And (senha='$senha')";
    $stmt = $con->query($sql);

    if ($stmt->rowCount() == 1) {
        // OK
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION['idadmin'] = (int) $admin['idadmin'];
        $_SESSION['nomeadmin'] = $admin['nome'];

        header('location:./');

        exit;
    }

    $msg[] = "Login e/ou Senha incorretos";
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

            <?php if ($msg) {
                msgHtml($msg);
            } ?>

            <form class="form-signin" role="form" method="post" action="login.php">
                <div class="form-group">
                    <label for="flogin" class="sr-only">Login: </label>
                    <input type="text" class="form-control" id="flogin" name="login" placeholder="Login">
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