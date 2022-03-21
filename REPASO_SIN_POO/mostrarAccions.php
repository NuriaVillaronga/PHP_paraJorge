<?php session_start();

    function mensaxe($cor, $mensaxe) {
        echo "<center>
                    <p><br>
                        <h3 style='color:".$cor.";'>".$mensaxe."</h3>
                    </p>
              </center>";
    }

    function opcionsAdmin() {
        echo "<center>
                <p><br><h1>Accións a realizar</h1></p>
                <p>
                    <br>
                    <form method='post'>
                        <p><button type='submit' formaction='./verUsuarios.php' name='verUsuarios_Admin'>Mostrar usuarios</button></p>
                        <p><button type='submit' formaction='./rexistro.php' name='rexistrarUser'>Rexistrar usuario</button></p>
                        <p><button type='submit' formaction='./login.html'>Volver inicio</button></p>
                    </form>
                </p>
            </center>";
    }

    function opcionsUser() {
		echo "<center>
                <p><br><h1>Accións a realizar</h1></p>
				<p>
					<br>
					<form method='post'>
						<p><button type='submit' formaction='./verUsuarios.php' name='verUsuarios_User'>Ver o meu usuario</button></p>
						<p><button type='submit' formaction='./login.html'>Volver inicio</button></p>
					</form>
				</p>
			</center>";
	}

    function crearSession($conexionPDO) {
        try {
            $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $existeUsuario->bindParam(':email', $_POST['email']);
            $existeUsuario->execute();

            if($existeUsuario->rowCount() != 0) {
                while ($fila = $existeUsuario->fetch(PDO::FETCH_ASSOC)) {
                    $contrasinalBD = $fila['contrasinal'];
                    $rol = $fila['rol'];
                    $nome = $fila['nome_usuario'];
                }

                if (password_verify($_POST['contrasinal'], $contrasinalBD)) {
                    $_SESSION['usuarios'] = ["nome_usuario" => $nome, "email" => $_POST['email'], "rol" => $rol, "contrasinal" => $_POST['contrasinal']];
                }
                else {
                    mensaxe("red", "O contrasinal introducido non é correcto");
                }
            }
            else {
                mensaxe("red", "O usuario có que intentaches loggearte non existe");
            }
        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $existeUsuario = null;
        }
    }

    function actualizarDataConexion($conexionPDO) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $dataConexion = date("Y-m-d H:i:s"); 

            $actualizarData = $conexionPDO->prepare("UPDATE usuarios SET data_conexion = :data_conexion WHERE email = '{$_SESSION['usuarios']['email']}'");
            $actualizarData->bindParam(':data_conexion', $dataConexion);
            $actualizarData->execute();
            
        }catch(PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $actualizarData = null;
        }
    }

    function mostrarAccions($conexionPDO) {

        if(isset($_SESSION['usuarios'])) {
            
            actualizarDataConexion($conexionPDO);

            if($_SESSION['usuarios']['rol'] == "Admin") {
                opcionsAdmin();
            }
            if($_SESSION['usuarios']['rol'] == "User") {
                opcionsUser();
            }
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=no_poo_repaso;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['loggin'])) {
            crearSession($conexionPDO);
            mostrarAccions($conexionPDO);
        }
    } catch (PDOException $error) {
        die("Erro na consulta executada: " . $error->getMessage());
    }
    finally {
        $conexionPDO = null;
    }
?>