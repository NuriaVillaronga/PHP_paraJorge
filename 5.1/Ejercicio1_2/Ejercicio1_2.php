<?php

class Contacto {

    private string $nome;
    private string $apelidos;
    private string $telefono; 

    public function __construct($nome, $apelidos, $telefono)
    {
        $this->nome = $nome;
        $this->apelidos = $apelidos;
        $this->telefono = $telefono;
    }

    public function __destruct() {
        return "Contacto eliminado";
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return ucwords($this->nome);
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = ucwords($nome);

        return $this;
    }

    /**
     * Set the value of apelidos
     *
     * @return  self
     */ 
    public function setApelidos($apelidos)
    {
        $this->apelidos = ucwords($apelidos);

        return $this;
    }

    /**
     * Get the value of apelidos
     */ 
    public function getApelidos()
    {
        return ucwords($this->apelidos);
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function asignaTelefono($telefono)
    {
        $this->telefono = $telefono;     

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function leTelefono()
    {
        if (strlen($this->telefono) == 9) 
        {
            return $this->telefono;
        }
        else {
            return null;
        }
    }

    public function mostraInformacion() {
        echo "<p>";
        echo "<b>Nome: </b>".ucwords($this->nome);
        echo "<br><b>Apelidos: </b>".ucwords($this->apelidos);
        if (strlen($this->telefono) != 9) {
            echo "<br><b>Teléfono: </b><u style='color:red;'>valor NON válido</u>";
        }
        else {
            echo "<br><b>Teléfono: </b>".$this->telefono;
        }
        echo "</p>";
    }
}