<?php
require './protege.php';
require './config.php';

$msg = array();

$idpostagem = 0;
if (isset($_GET['idpostagem'])) {
    $idpostagem = (int) $_GET['idpostagem'];
}

$con = Conexao::getConexao();

$sql = "Delete From postagem
        Where idpostagem = $idpostagem";

try {
    $stmt = $con->query($sql);

    javascriptAlertFim("Registro apagado", 'postagens.php');
} catch (PDOException $e) {
    $msg[] = "Não foi possível inserir o registro. Motivo: " . $e->getMessage();
    $msg[] = $sql;

    print_r($msg);
}