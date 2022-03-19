<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sesión A</title>
</head>
<body>
    <?php $_SESSION['usuario'] = "Xan"; ?> <!--Definimos a variable de sesión-->
    <h2>Estou na páxina 1A</h2>
    <a href="sesion1B.php">Ir a sesion1B</a>
</body>
</html>