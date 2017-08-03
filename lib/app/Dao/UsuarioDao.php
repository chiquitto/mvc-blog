<?php

namespace App\Dao;

use App\Conexao;
use App\Dao;
use App\Vo\Usuario;

class UsuarioDao extends Dao
{
    public function apagar($idusuario)
    {
        $con = Conexao::getConexao();

        $sql = "Delete From usuario
        Where idusuario = $idusuario";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível apagar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }

    public function cadastrar(Usuario $usuario)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($usuario->getNome() == '') {
            throw new \Exception('Informe o nome');
        }

        $nascimentoBd = $usuario->getNascimento()->format(DATE_BD);

        $sql = "Insert Into usuario
          (nome, nascimento, idcidade)
        Values
        ('{$usuario->getNome()}', 
          '{$nascimentoBd}', 
          '{$usuario->getIdcidade()}')";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível inserir o registro:' . $e->getMessage() . ":" . $sql);
        }

        $idusuario = (int) $con->lastInsertId();
        $usuario->setIdusuario($idusuario);
        return true;
    }

    public function editar(Usuario $usuario)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($usuario->getNome() == '') {
            throw new \Exception('Informe o nome');
        }

        $nascimentoBd = $usuario->getNascimento()->format(DATE_BD);

        $sql = "Update usuario Set
            nome = '{$usuario->getNome()}',
            nascimento = '{$nascimentoBd}',
            idcidade = '{$usuario->getIdcidade()}'
        Where idusuario = {$usuario->getIdusuario()}";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível atualizar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }
}