<?php

class CocheHidroxeno extends Coche
{
    public function consumir(){
        return 'O <b>' . __CLASS__ . '</b> consume hidroxeno';
    }
}