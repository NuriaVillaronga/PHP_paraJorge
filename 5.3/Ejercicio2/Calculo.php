<?php

abstract class Calculo {
    
    protected $operando1; 
    protected $operando2;
    protected $resultado;

    abstract public function calcular();

    /**
     * Set the value of operando1
     *
     * @return  self
     */ 
    public function setOperando1($operando1)
    {
        $this->operando1 = $operando1;

        return $this;
    }

    /**
     * Set the value of operando2
     *
     * @return  self
     */ 
    public function setOperando2($operando2)
    {
        $this->operando2 = $operando2;

        return $this;
    }

    /**
     * Get the value of resultado
     */ 
    public function getResultado()
    {
        if ($this->resultado == null) {
            return "Un ou ambos dos operandos son nulls ou non son numeros";
        }
        else {
            return $this->resultado;
        }
    }
}
