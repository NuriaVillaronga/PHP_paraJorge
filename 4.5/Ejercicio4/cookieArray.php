<?php

    if(isset($_GET['loggear'])) {
        if ($_GET['nome'] != "" and $_GET['apelido'] != "" and $_GET['email'] != "") {
            setcookie('usuario[nome]',$_GET['nome']);
            setcookie('usuario[apelido]',$_GET['apelido']);
            setcookie('usuario[email]',$_GET['email']);
        }
    }

    if(!empty($_COOKIE['usuario']) ) {
        foreach ($_COOKIE['usuario'] as $key=>$value) {
            echo "<b>$key</b>: $value <br>";
        }
    }
    else {
        echo "Todavía non hai cookies creadas";
    }

?>