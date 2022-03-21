<?php session_start();

    if(isset($_POST['pecharSesion'])) {
        session_destroy();
        header('Location: ./login.html');
    }

?>