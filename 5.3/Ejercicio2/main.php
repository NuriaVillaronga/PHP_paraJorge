<?php include './CalculoSC.php'; include './SumaSC.php'; include './RestaSC.php'; include './MultiplicacionSC.php';

    function realizarOperacion($objOperacion, $operando1, $operando2, $nomeOperacion) {
        $objOperacion->setOperando1($operando1);
        $objOperacion->setOperando2($operando2);
        $objOperacion->calcular();
        echo $nomeOperacion . ": <b>" .$objOperacion->getResultado() ."</b><br>";  
    }

    echo "<center>";
        echo "<h2>Operaciones sen empregar constructor</h2>";
                $suma = new SumaSC();
                realizarOperacion($suma, 5, 7, "Suma");
                $resta = new RestaSC();
                realizarOperacion($resta, 2, 4, "Resta");
                $multiplicacion =new MultiplicacionSC();
                realizarOperacion($multiplicacion, 9, 9, "Multiplicacion");
    echo "</center>";

