<?php session_start();

	function formPecharSesion() {
		echo "<form method='get'>
				<p><button type='submit' formaction='./pecheSesion.php' name='pecharSesion'>Pechar sesion</button></p>
			</form>";
	}

	function listaUsuarios($listaxeUsuarios) {
		echo "<center>";
			echo "O administrador <b>" . $_SESSION['usuarios']['nome'] . "</b> loggeouse con éxito";
			echo "<h3>Listaxe de usuarios</h3>";
			echo "<table border=1 style='border-collapse:collapse; width:900px; text-align:center'>
					<tr>
						<th>Nome</th>
						<th>Contrasinal</th>
						<th>Rol</th>
						<th>Última conexión</th>
					</tr>";
			while($fila=$listaxeUsuarios->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>
						<td>" . $fila['nome'] . "</td>
						<td>" . $fila['passwd'] . "</td>
						<td>" . $fila['rol'] . "</td>
						<td>" . $fila['ultima_conexion'] . "</td>
					</tr>";
			}
			echo "</table>";
			formPecharSesion();
		echo "</center>";
	}

	function actualizarUltimaConexion($conexionPDO, $nomeUsuario) {

		date_default_timezone_set('Europe/Madrid');
		$dataUltimaConexion = date("Y-m-d H:i:s");

		try {
			$actualizarUsuario = $conexionPDO->prepare("UPDATE usuarios SET ultima_conexion = :dataConexion WHERE nome = :nome");
			$actualizarUsuario->bindParam(':nome', $nomeUsuario);
			$actualizarUsuario->bindParam(':dataConexion', $dataUltimaConexion);
			$actualizarUsuario->execute();

		} catch (PDOException $error) {
			die("Erro na consulta executada: " . $error->getMessage());
		}
		finally {
			$actualizarUsuario = null;
		}
	}

	try {
		$conexionPDO = new PDO("mysql:host=db-pdo;dbname=crud;charset=utf8mb4", "root", "root");
		$conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_GET['loggin'])) {

            if ($_GET['usuario'] != null and $_GET['contrasinalLoggin'] != null) {

				/**
				* Primer acceso á páxina --> almacenar datos en variable $_SESSION
				*/
				try {
					$existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE nome = :usuario");
					$existeUsuario->bindParam(':usuario', $_GET['usuario']);
					$existeUsuario->execute();

					if ($existeUsuario->rowCount() == 0) {
						header('Location: login.php');
					}

					if ($existeUsuario->rowCount() != 0)  {

						while($fila=$existeUsuario->fetch(PDO::FETCH_ASSOC)) {
							$contrasinalBD = $fila['passwd'];
							$rolBD = $fila['rol'];
						}

						if (password_verify($_GET['contrasinalLoggin'],$contrasinalBD)) {
							$_SESSION['usuarios'] = ["nome"=>$_GET['usuario'], "contrasinal"=>$_GET['contrasinalLoggin'], "rol"=>$rolBD];
						}
						else {
							echo "<h3>Non introduciches unha contrasinal correcta</h3>";
						}
					}

				} catch (PDOException $error) {
					die("Erro na consulta executada: " . $error->getMessage());
				}
				finally {
					$existeUsuario = null;
				}           
            }
			else {
				echo "<h3>Os campos de acceso a loggin non poden estar baleiros</h3>";
			}
		}

		/**
		* Posteriores accesos á páxina --> O usuario xa accedeu unha vez polo que os seus datos están almacenados en $_SESSION
		*/
		if(isset($_SESSION['usuarios'])) {

			actualizarUltimaConexion($conexionPDO, $_SESSION['usuarios']['nome']);

			if ($_SESSION['usuarios']['rol'] == "admin") {
				
				try {
					$listaxeUsuarios = $conexionPDO->query("SELECT * FROM usuarios");
					listaUsuarios($listaxeUsuarios);

				} catch (PDOException $error) {
					die("Erro na consulta executada: " . $error->getMessage());
				}
				finally {
					$listaxeUsuarios = null;
				}
			}

			if ($_SESSION['usuarios']['rol'] == "user") {
				echo "O usuario <b>" . $_SESSION['usuarios']['nome'] . "</b> loggeouse con éxito";
				formPecharSesion();
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