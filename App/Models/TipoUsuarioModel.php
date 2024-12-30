<?php

namespace App\Models;
use PDO;
use App\Config\Connection;

class TipoUsuarioModel 
{
    private $idTipoUsuario;
    private $nmTipoUsuario;
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM tipo_usuario");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}