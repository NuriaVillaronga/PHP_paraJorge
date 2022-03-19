<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sesión B</title>
</head>
<body>

    <?php
        if($_GET['usuario'] !== null && $_GET['contrasinal'] !== null) {
            $datos = ["nome" => $_GET['usuario'], "contrasinal" => $_GET['contrasinal']]; 
            $_SESSION['datos'] = $datos; 
        }
    ?>
    
	<p><a href="sesion1A.php">Ir a sesion1A</a></p>

</body>
</html>