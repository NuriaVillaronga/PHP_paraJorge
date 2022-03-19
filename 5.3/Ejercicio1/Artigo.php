<?php

class Artigo {

    private int $id;
    private string $nome;

    public function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function __clone()
    {
        $this->nome = $this->nome; 
        $this->id = ($this->id)+1;
    }

    public function __toString() { 
        return $this->mostrarArtigo();
    }

    public function mostrarArtigo(){
        return "Id: <b>" .$this->id. "</b><br>Nome: <b>" .$this->nome. "</b>"; 
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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}