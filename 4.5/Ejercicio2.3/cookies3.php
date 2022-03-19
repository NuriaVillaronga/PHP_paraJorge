<?php

    function eliminarCookiesForm() {
        echo "<form method='get' action='eliminarCookie.php'>
                <p><button type='submit' name='eliminarCookie'>Eliminar cookies</button></p>
            </form>";
    }

    function amosarCookies() {
        echo "<table border=1 style='border-collapse:collapse; width:300px; text-align:center;'>
                <tr>
                    <th>Nome cookie</th>
                    <th>Valor cookie</th>
                </tr>";
        foreach ($_COOKIE as $key=>$value) {
            echo "<tr>
                    <td>".$key."</td>
                    <td>".$value."</td>
                 </tr>";
        }
        echo "</table>";
    }

    if(isset($_GET['crear'])) {
        if ($_GET['nome'] != "" and $_GET['valor'] != "") {
            setcookie($_GET['nome'], $_GET['valor'], time()+60); //Duracion de 2 minutos para cada cookie
        }
    }

    if(!empty($_COOKIE)) {
        amosarCookies();
        eliminarCookiesForm();
    }
    else {
        echo "Non hai cookies que amosar";
    }

?>