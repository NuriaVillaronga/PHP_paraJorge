<?php

namespace Clases;

use PDO;
use PDOException;

class Usuario extends Conexion
{
    private $nome;
    private $email;
    private $contrasinal;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Devuelve true si el usuario que intenta hacer login existe, y false si no existe
     *
     * @return bool
     */
    function isValid($email,$contrasinal) : bool
    {
        try {
            $existeUsuario = $this->conexion->query("SELECT * FROM usuarios WHERE email = {'$email'} and contrasinal = {'$contrasinal'}"); 
            if ($existeUsuario->rowCount() == 1)  {
                $usuario = true;
            }
            else {
                $usuario = false;
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $this->conexion = null; 
        }

        return $usuario;
    }


    function rexistroUsuario() {
        
    }


    /**
     * Get the value of contrasinal
     */ 
    public function getContrasinal()
    {
        return $this->contrasinal;
    }

    /**
     * Set the value of contrasinal
     *
     * @return  self
     */ 
    public function setContrasinal($contrasinal)
    {
        $this->contrasinal = $contrasinal;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}
