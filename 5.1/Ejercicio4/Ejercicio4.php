<?php

class Bombilla {

    private float $potencia;
    public static $numBombillas;

    public function __construct()
    {
        $this->potencia = 10;
        self::$numBombillas++;
    }

    public function __destruct() {
        self::$numBombillas--;
    }

    private function validacionPotencia($potencia) {
        if ($potencia > 35) {
            $potencia = 35;
        }
        if ($potencia < 2) {
            $potencia = 2;
        }
        return $potencia;
    }

    /**
     * Get the value of potencia
     */ 
    public function getPotencia()
    {
        return $this->validacionPotencia($this->potencia);
    }

    /**
     * Set the value of potencia
     *
     * @return  self
     */ 
    public function setPotencia($potencia)
    {
        $this->potencia = $potencia;

        return $this;
    }

    public function aumentaPotencia($val){
        $this->potencia = $this->potencia+$val;
        $this->potencia = $this->validacionPotencia($this->potencia);
        return $this->potencia;
    }

    public function baixaPotencia($val){
        $this->potencia = $this->potencia-$val;
        $this->potencia = $this->validacionPotencia($this->potencia);
        return $this->potencia;
    }
}