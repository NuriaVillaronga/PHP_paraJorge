<?php

class Conexion extends PDO {
    
    public function __construct() {

        try{
            parent::__construct("mysql:host=db-pdo;dbname=repaso_mvc;charset=utf8mb4", "root", "root"); //Conexion, user, password
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Erro na conexión: " . $e->getMessage());
        }
        
    }
}