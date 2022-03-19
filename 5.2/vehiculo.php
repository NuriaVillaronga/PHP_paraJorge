<?php

class Vehiculo {

    private string $matricula;
    private string $modelo;
    private float $kms;
    
    public function __construct($matricula, $modelo, $kms)
    {
        $this->matricula = $matricula;
        $this->modelo = $modelo;
        $this->kms = $kms;
    }

    /**
     * Get the value of matricula
     */ 
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Get the value of kms
     */ 
    public function getKms()
    {
        return $this->kms;
    }

    public function mostraEnTR() {
        echo "<tr>
                <td>".$this->getMatricula()."</td>
                <td>".$this->getModelo()."</td>
                <td>".$this->getKms()."</td>
            </tr>";
    }
}