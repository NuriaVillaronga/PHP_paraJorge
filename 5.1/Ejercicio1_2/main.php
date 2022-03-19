<?php include './Ejercicio1_2.php';

    $contacto1 = new Contacto("nuria","villaronga guillán","986552413");
    $contacto2 = new Contacto("moraima","villaronga guillán","986501927");
    $contacto3 = new Contacto("milena","villaronga guillán","986512846123");

    function obterDatos($contacto) {
        echo "<p>";
        echo "<b>Nome: </b>".$contacto->getNome();
        echo "<br><b>Apelidos: </b>".$contacto->getApelidos();
                if ($contacto->leTelefono() == null) {
                    echo "<br><b>Teléfono: </b><u style='color:red;'>valor NON válido</u>";
                }
                else {
                    echo "<br><b>Teléfono: </b>".$contacto->leTelefono();
                }
        echo "</p>";
    }

    echo "<center>";
        echo "<h3>Valores obtidos mediante mostraInformacion()</h3>";
              $contacto1->mostraInformacion();
              $contacto2->mostraInformacion();
              $contacto3->mostraInformacion();
        echo "<p><br>";
        echo "<h3>Valores obtidos mediante get()</h3>";
              obterDatos($contacto1);
              obterDatos($contacto2);
              obterDatos($contacto3);
        echo "</p>";
    echo "</center>";

    echo "<center>";
        echo "<p><br>";
        echo "<h3>Purgado de contactos con __destruct()</h3>";
                echo "1->" . $contacto1->__destruct();
                echo "<br>2->" . $contacto2->__destruct();
                echo "<br>3->" . $contacto3->__destruct();
        echo "</p>"; 
    echo "</center>";

