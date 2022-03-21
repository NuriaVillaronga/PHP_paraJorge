<?php

class Usuario {
    private string $nomeUser;
    private string $rol;
    private string $email;
    private string $contrasinal;

    public function __construct($nomeUser, $rol, $email, $contrasinal)
    {
        $this->nomeUser = $nomeUser;
        $this->rol = $rol;
        $this->email = $email;
        $this->contrasinal = $contrasinal;
    }

    /**
     * Get the value of nomeUser
     */ 
    public function getNomeUser()
    {
        return $this->nomeUser;
    }

    /**
     * Set the value of nomeUser
     *
     * @return  self
     */ 
    public function setNomeUser($nomeUser)
    {
        $this->nomeUser = $nomeUser;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

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
}