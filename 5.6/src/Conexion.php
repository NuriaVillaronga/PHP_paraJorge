<?php

namespace Clases;

use PDO;
use PDOException;

class Conexion extends PDO
{
    private $host;
    private $db;
    private $user;
    private $password;
    protected $dsn; 

    public function __construct()
    {
        $this->host = "db-pdo";
        $this->db ="proyecto";
        $this->user = "root";
        $this->password = "root";
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->conexion();
    }

    public function conexion() : PDO
    {
        try {
            $this->conexion = new PDO($this->dsn, $this->user, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexión: " . $e->getMessage());
        }

        return $this->conexion;
    }
} 