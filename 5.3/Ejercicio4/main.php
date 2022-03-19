<?php include './Coche.php'; include './CocheGasolina.php'; include './CocheElectrico.php'; include './CocheHidroxeno.php';

    function mostrar(Coche $coche) {
        echo "<center>";
        echo $coche->consumir(). "<br>";
        echo "</center>";
    }

    $cocheGasolina = new CocheGasolina();
    mostrar($cocheGasolina);

    $cocheElectrico = new CocheElectrico();
    mostrar($cocheElectrico);
    
    $cocheHidroxeno = new CocheHidroxeno();
    mostrar($cocheHidroxeno);