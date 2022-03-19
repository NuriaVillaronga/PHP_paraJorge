<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

	<center>
		<h1>Acceso á aplicación de alugueres</h1>
		<p>
			<br>
			<form method="get">
				<p>Email: <input type="email" name="emailLogin" size="30"></p>
				<p>Contrasinal: <input type="password" name="contrasinalLogin" size="30"></p>
				<p>
					<br>
					Selecciona o idioma: 
					<select name="idioma">
						<option value="castelan" selected>Castelán</option>
						<option value="galego">Galego</option>
						<option value="ingles">Inglés</option>
					</select>
				</p>
				<p>
					<br>
					<button type="submit" formaction="./mostra.php" name="loggin">Acceder</button>
					<p><button type="submit" formaction="./rexistro.html" name="rexistrarse">Rexistrarse</button></p>
					<p><button type="submit" formaction="./pechaSesion.php" name="peche">Pechar sesión</button></p>
				</p>
			</form>
		</p>
	</center>

<?php

	function mensaxeRexistro($cor, $mensaxe) {
		echo "<center>
				<p><br>
					<h3 style='color:".$cor.";'>".$mensaxe."<h3>
				</p>
			  </center>";
	}


	function insertarUsuario($conexionPDO, $usuario, $nome, $email, $data, $rol, $hashedPass) {
		try {
			$insertarUsuario = $conexionPDO->prepare("INSERT INTO usuarios (nome, nomeCompleto, email, contrasinal, dataConexion, rol) VALUES (:usuario, :nome, :email, :contrasinal, :dataRexistro, :rol)");
			
			$insertarUsuario->bindParam(':usuario', $usuario);
			$insertarUsuario->bindParam(':nome', $nome);
			$insertarUsuario->bindParam(':email', $email);
			$insertarUsuario->bindParam(':contrasinal', $hashedPass);
			$insertarUsuario->bindParam(':dataRexistro', $data);
			$insertarUsuario->bindParam(':rol', $rol);
					
			$insertarUsuario->execute();
			mensaxeRexistro("green","Usuario rexistrado con éxito! Loggeate");
		}
		catch (PDOException $error) {
			die("Erro na consulta executada: " . $error->getMessage());
		}
		finally {
			$insertarUsuario = null;
		}
	}


	try {
		$conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
		$conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_GET['engadirUsuario'])) {

			$rol = "User";
			date_default_timezone_set('Europe/Madrid');
			$dataRexistro = date("Y-m-d H:i:s"); 
			$hashedPass = password_hash($_GET['contrasinalRexistro'], PASSWORD_DEFAULT); 

			try {
				$existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email= :email");
				$existeUsuario->bindParam(':email', $_GET['emailRexistro']);
				$existeUsuario->execute();

				if($existeUsuario->rowCount() == 0) {
					insertarUsuario($conexionPDO, $_GET['usuario'], $_GET['nome'], $_GET['emailRexistro'], $dataRexistro, $rol, $hashedPass);
				}
				else {
					mensaxeRexistro("red","O usuario que intentaches rexitrar xa existe!");
				}
			} 
			catch (PDOException $error) {
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