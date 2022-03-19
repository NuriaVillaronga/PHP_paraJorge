<?php

trait DatosPersoa {
    
    private $nome;
    private $apelidos;
    private $idade;

    public function __toString() { 
        return $this->mostrarValores();
    }

    public function mostrarValores(){
        return "Nome: <b>" .$this->nome. "</b><br>Apelidos: <b>" .$this->apelidos. "</b><br>Idade: <b>" .$this->idade. "</b>"; 
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
     * Get the value of idade
     */ 
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * Set the value of idade
     *
     * @return  self
     */ 
    public function setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }
}