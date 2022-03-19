<?php

class Resta extends Calculo {

    public function calcular() {
        if ($this->operando1 != null and $this->operando2 != null and is_numeric($this->operando1) == true and is_numeric($this->operando2) == true) {
            $this->resultado = $this->operando1-$this->operando2;
        }
        else {
            $this->resultado = null;
        }
    }
}