<?php include './Calculo.php'; include './Suma.php'; include './Resta.php'; include './Multiplicacion.php';

    function realizarOperacion($objOperacion, $operando1, $operando2, $nomeOperacion) {
        $objOperacion->setOperando1($operando1);
        $objOperacion->setOperando2($operando2);
        $objOperacion->calcular();
        echo $nomeOperacion . ": <b>" .$objOperacion->getResultado() ."</b><br>";  
    }

    echo "<center>";
        echo "<h2>Operaciones sen empregar constructor</h2>";
                $suma = new Suma();
                realizarOperacion($suma, 5, 7, "Suma");
                $resta = new Resta();
                realizarOperacion($resta, 2, 4, "Resta");
                $multiplicacion =new Multiplicacion();
                realizarOperacion($multiplicacion, 9, 9, "Multiplicacion");
    echo "</center>";

