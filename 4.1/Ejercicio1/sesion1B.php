<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sesión B</title>
</head>
<body>
    <?php echo "O usuario é ", $_SESSION['usuario']; ?> <!--Acceso á variable de sesión-->
    <h2>Estou na páxina 1B</h2>
    <a href="sesion1A.php">Ir a sesion1A</a>
</body>
</html>