<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sesión A</title>
</head>
<body>

	<form action="sesion1B.php" method="get">
		Usuario: <input type="text" name="usuario" size="30"><br/>
		Contrasinal: <input type="password" name="contrasinal" size="20"><br/>
		<input type="submit" value="Enviar">  
	</form>

    <?php
		if ($_SESSION['datos']['nome'] !== null && $_SESSION['datos']['contrasinal'] !== null) {
			echo "<p>O usuario da sesión é <b>".$_SESSION['datos']['nome']."</b> con contrasinal <b>".$_SESSION['datos']['contrasinal']."</b></p>";
		}
	?>
    
	<p><a href="sesion1B.php">Ir a sesion1B</a></p> 

</body>
</html>