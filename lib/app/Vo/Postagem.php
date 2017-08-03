<?php

namespace App\Vo;

use App\Vo;

class Postagem extends Vo
{
    /**
     * @var int
     */
    private $idpostagem;

    /**
     * @var int
     */
    private $idcategoria;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $texto;

    /**
     * @var \DateTime
     */
    private $datacadastro;

    /**
     * @var int
     */
    private $idadmin;

    /**
     * @var int
     */
    private $situacao;

    /**
     * @return int
     */
    public function getIdpostagem()
    {
        return $this->idpostagem;
    }

    /**
     * @param int $idpostagem
     */
    public function setIdpostagem($idpostagem)
    {
        $this->idpostagem = $idpostagem;
    }

    /**
     * @return int
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * @param int $idcategoria
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    /**
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param string $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return \DateTime
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param \DateTime $datacadastro
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
    }

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
     * @return int
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param int $situacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }


}