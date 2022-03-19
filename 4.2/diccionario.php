<?php session_start(); 

    echo "<center>
            <p><br>
                <form method='get'>
                    <button formaction='./rexistro.php'>Rexistrar nova palabra</button>
                </form>
            </p>
        </center>";

    $diccionario = [];

    if (isset($_GET['insertar'])) {

        if($_GET['galego'] != null and $_GET['ingles'] != null) {
            $diccionario = [$_GET['ingles'],$_GET['galego']];

            foreach ($_SESSION['diccionario'] as $palabra=>$item) {
                if ($item[0] == $_GET['ingles'] || $item[1] == $_GET['galego']) {
                    echo "<h3><center>A palabra que queres engadir, xa está no diccionario.</h3></center>";
                    die();
                }
            }

            $_SESSION['diccionario'][] = $diccionario;
        }
        else {
            echo "<h3>Para engadir unha nova palabra ao diccionario, debes introducila en galego e ingles.</h3>";
        }
    }

    if (empty($_SESSION['diccionario']) == false) {
        echo "<center>";
        echo "<form>
              <table border=1 style='width:800px; border-collapse:collapse; text-align:center;'>
                <tr>
                    <th>Inglés</th>
                    <th>Galego</th>
                    <th>Accións</th>
                </tr>";
        foreach ($_SESSION['diccionario'] as $palabra=>$item) {
            echo "<tr>
                    <td>" . $item[0] . "</td>
                    <td>" . $item[1] . "</td>
                    <td><button name='eliminarPalabra' formaction='./diccionario.php' value=".$palabra.">Eliminar</button></td>
                 </tr>";
        }
        echo "</table>
              </form>";
        echo "</center>";
    }
    else {
        echo "<center>Todavía non hay palabras que mostrar. Inserta unha nova</center>";
    }

    if (isset($_GET['eliminarPalabra'])) {

        foreach ($_SESSION['diccionario'] as $palabra=>$item) {
            if ($_GET['eliminarPalabra'] == $palabra) {
                unset($_SESSION['diccionario'][$palabra]);
            }
        }
    }

?>
