<?php

namespace App\Models;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use App\Models\SituacaoModel;
use PDO;


class TarefaModel
{
    private $idTarefa;
    private $cdTarefa;
    private UsuarioModel $usuario;
    private CategoriaModel $categoria;
    private SituacaoModel $situacao;
    private $dsTarefa;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->usuario = new UsuarioModel($this->db);
        $this->categoria = new CategoriaModel($this->db);
        $this->situacao = new SituacaoModel($this->db);
    }

    public function getIdTarefa()
    {
        return $this->idTarefa;
    }

    public function setIdTarefa($idTarefa)
    {
        $this->idTarefa = $idTarefa;
    }

    public function getCdTarefa()
    {
        return $this->cdTarefa;
    }

    public function setCdTarefa($cdTarefa)
    {
        $this->cdTarefa = $cdTarefa;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario(UsuarioModel $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(CategoriaModel $categoria)
    {
        $this->categoria = $categoria;
    }

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao(SituacaoModel $situacao)
    {
        $this->situacao = $situacao;
    }

    public function getDsTarefa()
    {
        return $this->dsTarefa;
    }

    public function setDsTarefa($dsTarefa)
    {
        $this->dsTarefa = $dsTarefa;
    }
}