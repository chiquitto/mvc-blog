<?php
require './protege.php';
require './config.php';

$msg = array();

$nome = '';
$login = '';
$senha = '';
$senha2 = '';

if ($_POST) {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];

    if ($senha != $senha2) {
        $msg[] = 'A confirmação da senha deve ser igual a senha';
    }

    if (!$msg) {
        $adminVo = new \App\Vo\Admin();
        $adminVo->setNome($nome);
        $adminVo->setLogin($login);
        $adminVo->setSenha($senha);

        $autorDao = new \App\Dao\AdminDao();

        try {
            $autorDao->cadastrar($adminVo);

            header('location: autores.php');
            exit;
        } catch (Exception $e) {
            $msg[] = $e->getMessage();
        }
    }
}

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

    <form role="form" method="post" action="">

        <div class="form-group">
            <label for="fnome">Nome</label>
            <input type="text" class="form-control" id="fnome" name="nome" placeholder="Nome completo"
                   value="<?php echo $nome; ?>">
        </div>

        <div class="form-group">
            <label for="flogin">Login</label>
            <input type="text" class="form-control" id="flogin" name="login" placeholder="Login de acesso"
                   value="<?php echo $login; ?>">
        </div>

        <div class="form-group">
            <label for="fsenha">Senha</label>
            <input type="password" class="form-control" id="fsenha" name="senha"
                   value="<?php echo $senha; ?>">
        </div>

        <div class="form-group">
            <label for="fsenha2">Confirme a senha</label>
            <input type="password" class="form-control" id="fsenha2" name="senha2"
                   value="<?php echo $senha2; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>