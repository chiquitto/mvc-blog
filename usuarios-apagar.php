<?php
require './protege.php';
require './config.php';

$msg = array();

$idusuario = 0;
if (isset($_GET['idusuario'])) {
    $idusuario = (int) $_GET['idusuario'];
}

$usuarioDao = new \App\Dao\UsuarioDao();

try {
    $usuarioDao->apagar($idusuario);

    javascriptAlertFim("Registro apagado", 'usuarios.php');
} catch (PDOException $e) {
    $msg[] = $e->getMessage();

    print_r($msg);
}