<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

	<form method="get">
		Usuario: <input type="text" name="usuario" size="30">
		<p>Contrasinal: <input type="password" name="contrasinalLoggin" size="20"></p>
		<p>
			<button type="submit" formaction="./mostra.php" name="loggin">Loggeate</button>
			<button type="submit" formaction="./rexistro.html" name="rexistrarse">Rexistrarse</button>
		</p>
	</form>

<?php

	try {
		$conexionPDO = new PDO("mysql:host=db-pdo;dbname=crud;charset=utf8mb4", "root", "root");
		$conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_GET['engadirRexistro'])) {
						
			$hashedPasswd = password_hash($_GET['contrasinal'], PASSWORD_DEFAULT); 

			date_default_timezone_set('Europe/Madrid');
			$dataRexistro = date("Y-m-d H:i:s");

			try {

				$existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE nome = :nome "); 
				$existeUsuario->bindParam(':nome', $_GET['nome']);
				$existeUsuario->execute();

				if($existeUsuario->rowCount() == 0)
				{
					try {
						
						$insertarUsuario = $conexionPDO->prepare("INSERT INTO usuarios (nome, passwd, ultima_conexion, rol) VALUES (:nome, :contrasinal, :dataRexistro, :rol)");
						$insertarUsuario->bindParam(':nome', $_GET['nome']);
						$insertarUsuario->bindParam(':contrasinal', $hashedPasswd);
						$insertarUsuario->bindParam(':dataRexistro', $dataRexistro);
						$insertarUsuario->bindParam(':rol', $_GET['rol']);
								
						$insertarUsuario->execute();
						echo "<h3>Usuario rexistrado con éxito! Loggeate</3>";
					}
					catch (PDOException $error) {
						die("Erro na consulta executada: " . $error->getMessage());
					}
					finally {
						$insertarUsuario = null;
					}
				}
				else {
					echo "<h3>O usuario que intentaches rexitrar xa existe!</h3>";
				}

			} catch (PDOException $error) {
				die("Erro na consulta executada: " . $error->getMessage());
			}
			finally {
				$existeUsuario = null;
			}
		}

	} catch (PDOException $error) {
		die("Erro na conexion coa base de datos: " . $error->getMessage());
	}
	finally {
		$conexionPDO = null;
	}
?>

</body>
</html>