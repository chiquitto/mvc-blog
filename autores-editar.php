<?php
require './protege.php';
require './config.php';

$msg = array();

$idadmin = 0;
$nome = '';
$login = '';

if (isset($_POST['idadmin'])) {
    $idadmin = (int) $_POST['idadmin'];
} elseif (isset($_GET['idadmin'])) {
    $idadmin = (int) $_GET['idadmin'];
}

$con = \App\Conexao::getConexao();

if ($_POST) {
    $nome = $_POST['nome'];
    $login = $_POST['login'];

    if (!$msg) {
        $adminVo = new \App\Vo\Admin();
        $adminVo->setIdadmin($idadmin);
        $adminVo->setNome($nome);
        $adminVo->setLogin($login);

        $autorDao = new \App\Dao\AdminDao();

        try {
            $autorDao->editar($adminVo);

            header('location: autores.php');
            exit;
        } catch (Exception $e) {
            $msg[] = $e->getMessage();
        }
    }
} else {
    $sql = "Select nome, login From admin Where idadmin = $idadmin";
    $stmt = $con->query($sql);

    if ($stmt->rowCount() == 0) {
        javascriptAlertFim("Registro inexistente", "./");
    }

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    $nome = $admin['nome'];
    $login = $admin['login'];
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
        <h1><i class="fa fa-user-secret"></i> Editar autor</h1>
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

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<?php include PATH . '/rodape.php'; ?>

</body>
</html>