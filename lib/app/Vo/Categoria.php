<?php

namespace App\Vo;

use App\Vo;

class Categoria extends Vo
{
    /**
     * @var int
     */
    private $idcategoria;
    /**
     * @var string
     */
    private $categoria;
    /**
     * @var string
     */
    private $descricao;
    /**
     * @var int
     */
    private $situacao;

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
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param string $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
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