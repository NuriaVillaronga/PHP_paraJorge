<?php

class Conexion extends PDO {

    private $conexion; 
    
    public function __construct() {

        $this->conexion = "mysql:host=db-pdo;dbname=repaso_mvc;charset=utf8mb4";
        
        try{
            parent::__construct($this->conexion, "root", "root"); //Conexion, user, password
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Erro na conexión: " . $e->getMessage());
        }
        
    }
}