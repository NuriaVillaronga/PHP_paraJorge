<?php session_start();
    if (isset($_GET['peche'])) {
        session_destroy();
        header('Location: ./flotaVehiculos.php');
    }
?> 