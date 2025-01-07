<?php

namespace App\Models;
use App\Models\UsuarioModel;
use App\Models\CategoriaModel;
use PDO;


class TarefaModel
{
    private $idTarefa;
    private $cdTarefa;
    private UsuarioModel $idUsuario;
    private CategoriaModel $idCategoria;
    private $idSituacao;
    private $dsTarefa;
}