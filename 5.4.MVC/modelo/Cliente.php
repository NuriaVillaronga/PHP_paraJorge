<?php

class Cliente {

    private string $nome;
    private string $apelidos;
    private string $email;

    public function __construct($nome, $apelidos, $email){
        $this->nome = $nome;
        $this->apelidos = $apelidos;
        $this->email = $email;
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

    /**
     * Get the value of apelidos
     */ 
    public function getApelidos()
    {
        return $this->apelidos;
    }

    /**
     * Set the value of apelidos
     *
     * @return  self
     */ 
    public function setApelidos($apelidos)
    {
        $this->apelidos = $apelidos;

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
}