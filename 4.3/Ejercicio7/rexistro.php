<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Táboas de usuarios</title>
</head>
<body>

	<form action="datos.php" method="get">
		<br>Usuario: <input type="text" name="nome" size="30">
		<br>Contrasinal: <input type="password" name="contrasinal" size="20">
		<p><button type="submit" name="enviarDatos">Rexistrar</button></p>
	</form>
	
</body>
</html>