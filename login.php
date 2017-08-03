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

$view = \App\View::getView();
$view->assign('msg', $msg);
$view->display('login.tpl');