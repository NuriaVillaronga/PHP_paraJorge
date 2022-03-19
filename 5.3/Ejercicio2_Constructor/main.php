<?php include './Calculo.php'; include './Suma.php'; include './Resta.php'; include './Multiplicacion.php';

    function realizarOperacion($objOperacion, $nomeOperacion) {
        $objOperacion->calcular();
        echo $nomeOperacion . ": <b>" .$objOperacion->getResultado() ."</b><br>";  
    }

    echo "<center>";
        echo "<h2>Operacions empregando constructor</h2>";
                $suma = new Suma(3,7);
                realizarOperacion($suma, "Suma");
                $resta = new Resta(14,8);
                realizarOperacion($resta, "Resta");
                $multiplicacion =new Multiplicacion(2,7);
                realizarOperacion($multiplicacion,"Multiplicacion");
    echo "</center>";

