<?php
require './protege.php';
require './config.php';

$msg = array();

$idpostagem = 0;
if (isset($_GET['idpostagem'])) {
    $idpostagem = (int) $_GET['idpostagem'];
}

$postagemDao = new \App\Dao\PostagemDao();

try {
    $postagemDao->apagar($idpostagem);

    javascriptAlertFim("Registro apagado", 'postagens.php');
} catch (PDOException $e) {
    $msg[] = $e->getMessage();

    print_r($msg);
}