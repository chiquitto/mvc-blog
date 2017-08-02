<?php

namespace App\Dao;

use App\Conexao;
use App\Dao;
use App\Vo\Categoria;

class CategoriaDao extends Dao
{
    public function cadastrar(Categoria $categoria)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($categoria->getCategoria() == '') {
            throw new \Exception('Informe o nome da categoria');
        }

        $sql = "Insert Into categoria
          (categoria, descricao, situacao)
        Values
        ('{$categoria->getCategoria()}', 
          '{$categoria->getDescricao()}', 
          '{$categoria->getSituacao()}')";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível inserir o registro:' . $e->getMessage() . ":" . $sql);
        }

        $idcategoria = (int) $con->lastInsertId();
        $categoria->setIdcategoria($idcategoria);
        return true;
    }

    public function editar(Categoria $categoria)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($categoria->getCategoria() == '') {
            throw new \Exception('Informe o nome da categoria');
        }

        $sql = "Update categoria Set
            categoria = '{$categoria->getCategoria()}',
            descricao = '{$categoria->getDescricao()}',
            situacao = '{$categoria->getSituacao()}'
            Where idcategoria = {$categoria->getIdcategoria()}";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível atualizar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }
}