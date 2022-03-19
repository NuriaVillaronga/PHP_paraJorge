<?php session_start();

	function formPecharSesion() {
		echo "<form method='get'>
				<p><button type='submit' formaction='./pecheSesion.php' name='pecharSesion'>Pechar sesion</button></p>
			</form>";
	}

	//Primer acceso a través de loggin
	try {
		$conexionPDO = new PDO("mysql:host=db-pdo;dbname=crud;charset=utf8mb4", "root", "root");
		$conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(isset($_GET['loggin'])) {

            if ($_GET['usuario'] != null and $_GET['contrasinalLoggin'] != null) {
                
                try {
                    $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE nome='{$_GET['usuario']}'");
                    $existeUsuario->execute();

					if ($existeUsuario->rowCount() == 0) {
						header('Location: login.php');
					}

                    if ($existeUsuario->rowCount() != 0)  {
                        
                        $contrasinal = null;
						$rol = null;

                        while($fila=$existeUsuario->fetch(PDO::FETCH_ASSOC)) {
                            $contrasinal = $fila['passwd'];
							$rol = $fila['rol'];
                        }

                        if (password_verify($_GET['contrasinalLoggin'],$contrasinal)) {
                            $_SESSION['usuarios'] = ["nome"=>$_GET['usuario'], "contrasinal"=>$_GET['contrasinalLoggin'], "rol"=>$rol];
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

	} catch (PDOException $error) {
		die("Erro na conexion coa base de datos: " . $error->getMessage());
	}
	finally {
		$conexionPDO = null;
	}

    //Posteriores accesos
    if(isset($_SESSION['usuarios'])) {

        if ($_SESSION['usuarios']['rol'] == "admin") {
            
			try {
                $conexionPDO = new PDO("mysql:host=db-pdo;dbname=crud;charset=utf8mb4","root","root");
                $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				try {

					$listaxeUsuarios = $conexionPDO->prepare("SELECT * FROM usuarios");
					$listaxeUsuarios->execute();

					echo "O administrador <b>" . $_SESSION['usuarios']['nome'] . "</b> loggeouse con éxito";
					echo "<h3>Listaxe de usuarios</h3>";
					echo "<table border=1 style='border-collapse:collapse; width:600px; text-align:center'>
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

				} catch (PDOException $error) {
					die("Erro na consulta executada: " . $error->getMessage());
				}
				finally {
					$listaxeUsuarios = null;
				}

			} catch (PDOException $error) {
				die("Erro na consulta executada: " . $error->getMessage());
			}
			finally {
				$conexionPDO = null;
			}	
        }

        if ($_SESSION['usuarios']['rol'] == "user") {
            echo "O usuario <b>" . $_SESSION['usuarios']['nome'] . "</b> loggeouse con éxito";
			formPecharSesion();
        }   
    }
?>

</body>
</html>