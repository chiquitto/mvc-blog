<?php

namespace App\Vo;

use App\Vo;

class Admin extends Vo
{
    /**
     * @var int
     */
    private $idadmin;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $senha;

    /**
     * @return int
     */
    public function getIdadmin()
    {
        return $this->idadmin;
    }

    /**
     * @param int $idadmin
     */
    public function setIdadmin($idadmin)
    {
        $this->idadmin = $idadmin;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }




}