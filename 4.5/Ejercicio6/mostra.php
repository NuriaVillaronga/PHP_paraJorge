<?php 
    if (isset($_GET['seleccion'])) {
        if ($_GET['idioma'] == "castelan") {
            setcookie("Texto","Bienvenido a la actividad 6 de cookies");
        }
        if ($_GET['idioma'] == "galego") {
            setcookie("Texto","Benvido a actividade 6 de cookies");
        }
        if ($_GET['idioma'] == "ingles") {
            setcookie("Texto","Welcome to activity 6 of cookies"); 
        }
    }

    if(!empty($_COOKIE)) {
        foreach ($_COOKIE as $key=>$value) {
            if ($key == "Texto") {
                echo "<h2 style='color:#67009B;'>".$value."</h2>";
            }
        }
    }
    else {
        echo "<h3 style='color:red;'>Todavía non hai cookies creadas</h3>";
    }