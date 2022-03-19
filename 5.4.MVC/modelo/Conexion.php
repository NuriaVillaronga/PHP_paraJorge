<?php

class Conexion extends PDO
{
    private $host = "db-pdo";
    private $db = "proba";
    private $user = "root";
    private $password = "root";
    private $conexion; 
    
    public function __construct() {
        $this->conexion = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        
        try{
            parent::__construct($this->conexion, $this->user, $this->password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Erro na conexión: mensaxe: " . $e->getMessage());
        }
    }
} 