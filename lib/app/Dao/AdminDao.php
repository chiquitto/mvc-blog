<?php

namespace App\Dao;

use App\Conexao;
use App\Dao;
use App\Vo\Admin;

class AdminDao extends Dao
{
    public function cadastrar(Admin $admin)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($admin->getNome() == '') {
            throw new \Exception('Informe o nome completo');
        }
        if ($admin->getLogin() == '') {
            throw new \Exception('Informe o login de acesso');
        }
        if ($admin->getSenha() == '') {
            throw new \Exception('Informe a senha');
        }

        $sql = "Insert Into admin
          (nome, login, senha)
        Values
        ('{$admin->getNome()}', 
          '{$admin->getLogin()}', 
          '{$admin->getSenha()}')";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível inserir o registro:' . $e->getMessage() . ":" . $sql);
        }

        $idadmin = (int) $con->lastInsertId();
        $admin->setIdadmin($idadmin);
        return true;
    }

    public function editar(Admin $admin)
    {
        $con = Conexao::getConexao();

        // Validar informações
        if ($admin->getNome() == '') {
            throw new \Exception('Informe o nome completo');
        }
        if ($admin->getLogin() == '') {
            throw new \Exception('Informe o login de acesso');
        }

        $sql = "Update admin Set
            nome = '{$admin->getNome()}',
            login = '{$admin->getLogin()}'
            Where idadmin = {$admin->getIdadmin()}";

        try {
            $stmt = $con->query($sql);
        } catch (PDOException $e) {
            throw new \Exception('Não foi possível atualizar o registro:' . $e->getMessage() . ":" . $sql);
        }

        return true;
    }

    public function login(Admin $admin) {
        $sql = "Select idadmin, nome
          From admin
          Where (login='{$admin->getLogin()}') And (senha='{$admin->getSenha()}')";

        $con = Conexao::getConexao();

        $stmt = $con->query($sql);

        if ($stmt->rowCount() != 1) {
            throw new \Exception('Login e/ou senha invalidos');
        }

        $adminBd = $stmt->fetch(\PDO::FETCH_ASSOC);

        $admin->setIdadmin((int) $adminBd['idadmin']);
        $admin->setNome($adminBd['nome']);

        return true;
    }
}
