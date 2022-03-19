<?php include './Bombilla.php';

    $bombilla = new Bombilla();
    $bombilla->setPotencia(60);

    echo "Potencia bombilla a 60W: <b><u>" . $bombilla->getPotencia() . "W</u></b>";  
    echo "<br>Subida de potencia +50W: <b><u>" . $bombilla->aumentaPotencia(50) . "W</u></b>"; 
    echo "<br>Disminucion de potencia -10W: <b><u>" . $bombilla->baixaPotencia(10) . "W</u></b>"; 

    $bombilla->setPotencia(10);

    echo "<p>";
        echo "Potencia bombilla a 10W: <b><u>" . $bombilla->getPotencia() . "W</u></b>"; 
        echo "<br>Disminucion de potencia -20W: <b><u>" . $bombilla->baixaPotencia(20) . "W</u></b>";    
    echo "</p>";