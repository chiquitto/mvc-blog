<?php
require './config.php';

$msg = array();

if ($_POST) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $adminVo = new \App\Vo\Admin();
    $adminVo->setLogin($login);
    $adminVo->setSenha($senha);

    $adminDao = new \App\Dao\AdminDao();

    try {
        $adminDao->login($adminVo);

        session_start();
        $_SESSION['idadmin'] = $adminVo->getIdadmin();
        $_SESSION['nomeadmin'] = $adminVo->getNome();

        header('location:./');
        exit;
    } catch (Exception $e) {
        $msg[] = $e->getMessage();
    }
}

$view = \App\View::getView();
$view->assign('msg', $msg);
$view->display('login.tpl');