<?php

namespace App\Vo;

use App\Vo;

class Usuario extends Vo
{
    /**
     * @var int
     */
    private $idusuario;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var \DateTime
     */
    private $nascimento;

    /**
     * @var int
     */
    private $idcidade;

    /**
     * @return int
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @param int $idusuario
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
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
     * @return \DateTime
     */
    public function getNascimento()
    {
        return $this->nascimento;
    }

    /**
     * @param \DateTime $nascimento
     */
    public function setNascimento(\DateTime $nascimento)
    {
        $this->nascimento = $nascimento;
    }

    /**
     * @return int
     */
    public function getIdcidade()
    {
        return $this->idcidade;
    }

    /**
     * @param int $idcidade
     */
    public function setIdcidade($idcidade)
    {
        $this->idcidade = $idcidade;
    }



}