<?php include './Bombilla.php';

    $bombilla1 = new Bombilla();
    echo "Subida de potencia +20W: <b><u>" . $bombilla1->aumentaPotencia(20) . "W</u></b>";
    echo "<br>Número total de bomillas: <b><u>" . $bombilla1::$numBombillas . "</u></b>";  

    $bombilla2 = new Bombilla();
    echo "<p>";
        echo "Subida de potencia +30W: <b><u>" . $bombilla2->aumentaPotencia(30) . "W</u></b>"; 
        echo "<br>Número total de bomillas: <b><u>" . $bombilla2::$numBombillas . "</u></b>"; 
        echo "<br>Disminucion de potencia -10W: <b><u>" . $bombilla2->baixaPotencia(10) . "W</u></b>";    
    echo "</p>";

    echo "<p>"; 
        $bombilla1->__destruct();
        echo "Número total de bomillas tras eliminar a bombilla1: <b><u>" . $bombilla2::$numBombillas . "</u></b>";    
    echo "</p>";

