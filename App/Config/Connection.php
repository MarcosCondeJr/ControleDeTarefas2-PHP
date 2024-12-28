<?php

namespace App\Config;
use PDO;

class Connection
{
    private $host     = 'localhost';
    private $port     = '5432';
    private $dbname   = 'controle_tarefas';
    private $password = '1234';
    private $user     = 'postgres';
    private $conn;

    public function connect()
    {
        try
        {
            $query = "pgsql:
                      host     = {$this->host};
                      port     = {$this->port};
                      dbname   = {$this->dbname};
                      password = {$this->password};
                      user     = {$this->user};
                     ";
            $this->conn = new PDO($query);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        }
        catch(\PDOException $e)
        {
            echo "Erro na conexão: " . $e->getMessage();
            return null;
        }
    }

    public function close() 
    {
        $this->connection = null; 
    }
}