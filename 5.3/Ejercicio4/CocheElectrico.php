<?php

class CocheElectrico extends Coche
{
    public function consumir(){
        return 'O <b>' . __CLASS__ . '</b> consume electricidade';
    }
}