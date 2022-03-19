<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xestion</title>
</head>
<body>
	<center>
		<h1>Selecciona a xestión que desexas facer</h1>
		<form method="get">
			<p>
				<button type="submit" formaction="./xestionProductos.php" name="xestionProductos">Xestionar productos</button>
				<p><button type="submit" formaction="./xestionAlugados.php" name="xestionAlugados">Xestionar alugados</button></p>
				<p><button type="submit" formaction="./xestionUsuarios.php" name="xestionUsuarios">Xestionar usuarios</button></p>
			</p>
			<p><br><button formaction='./login.php' name='volverInicio'>Volver ao inicio</button></p>
			<p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
		</form>
	</center>
</body>
</html>