<?php session_start();

    if (isset($_GET['pecharSesion'])) {
        session_destroy();
        header('Location: ./login.php');
    }
    
?> 