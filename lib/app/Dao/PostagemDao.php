<?php

namespace App\Dao;

use App\Conexao;
use App\Dao;
use App\Vo\Postagem;

class PostagemDao extends Dao
{
    public function apagar($idpostagem)
    {
        $con = Conexao::getConexao();

        $sql = "Delete From postagem
        Where idpostagem = $idpostagem";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível apagar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }

    public function cadastrar(Postagem $postagem)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($postagem->getIdcategoria() <= 0) {
            throw new \Exception('Informe a categoria');
        }
        if ($postagem->getTitulo() == '') {
            throw new \Exception('Informe o título');
        }
        if ($postagem->getTexto() == '') {
            throw new \Exception('Informe o texto');
        }
        if ($postagem->getIdadmin() == '') {
            throw new \Exception('Informe o autor');
        }

        $dataCadastroBd = date(DATE_BD);

        $sql = "Insert Into postagem
            (idcategoria, titulo, texto,
            datacadastro, idadmin, situacao)
        Values
            ({$postagem->getIdcategoria()}, 
            '{$postagem->getTitulo()}', 
            '{$postagem->getTexto()}', 
            '{$dataCadastroBd}', 
            {$postagem->getIdadmin()}, 
            '{$postagem->getSituacao()}')";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível inserir o registro:' . $e->getMessage() . ":" . $sql);
        }

        $idpostagem = (int) $con->lastInsertId();
        $postagem->setIdpostagem($idpostagem);
        return true;
    }

    public function editar(Postagem $postagem)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($postagem->getIdcategoria() <= 0) {
            throw new \Exception('Informe a categoria');
        }
        if ($postagem->getTitulo() == '') {
            throw new \Exception('Informe o título');
        }
        if ($postagem->getTexto() == '') {
            throw new \Exception('Informe o texto');
        }

        $sql = "Update postagem Set
            idcategoria = '{$postagem->getIdcategoria()}',
            titulo = '{$postagem->getTitulo()}',
            texto = '{$postagem->getTexto()}',
            situacao = '{$postagem->getSituacao()}'
        Where idpostagem = {$postagem->getIdpostagem()}";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível atualizar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }
}