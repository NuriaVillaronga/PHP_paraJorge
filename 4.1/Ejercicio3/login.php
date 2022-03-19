<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

	<form action="datos.php" method="get">
		Usuario: <input type="text" name="usuario" size="30"><br/>
		Contrasinal: <input type="password" name="contrasinal" size="20"><br/>
		<button type="submit" name="loggin">Loggin</button> 
	</form>

</body>
</html>