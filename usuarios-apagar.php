<?php
require './protege.php';
require './config.php';

$msg = array();

$idusuario = 0;
if (isset($_GET['idusuario'])) {
    $idusuario = (int) $_GET['idusuario'];
}

$con = Conexao::getConexao();

$sql = "Delete From usuario
        Where idusuario = $idusuario";

try {
    $stmt = $con->query($sql);

    javascriptAlertFim("Registro apagado", 'usuarios.php');
} catch (PDOException $e) {
    $msg[] = "Não foi possível inserir o registro. Motivo: " . $e->getMessage();
    $msg[] = $sql;

    print_r($msg);
}