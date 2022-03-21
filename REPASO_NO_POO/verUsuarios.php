<?php session_start();

    function mensaxe($cor, $mensaxe) {
        echo "<center>
                    <p><br>
                        <h3 style='color:".$cor.";'>".$mensaxe."</h3>
                    </p>
                    <p><br>
                        <form method='post'>
                            <br><button type='submit' formaction='./login.html'>Volver ao inicio</button>
                            <p><button type='submit' formaction='./pecharSesion.php' name='pecharSesion'>Pechar sesión</button></p>
                        </form>
                    </p>
            </center>";
    }

    function taboaAllUsers($mostrarAllUsers) {
        echo "<center><p><br><h1>Listaxe de usuarios</h1></p>";
        echo "<table border=1 style='border-collapse:collapse; text-align:center; width:1400px;'>
                    <tr>
                        <th>Nome de usuario</th>
                        <th>Email</th> 
                        <th>Contrasinal</th>
                        <th>Rol</th>
                        <th>Data rexistro</th>
                        <th>Ultima data conexión</th>
                        <th>Accións</th>
                    </tr>";
               while($fila=$mostrarAllUsers->fetch(PDO::FETCH_ASSOC)) { 
			   echo "<tr>
                        <td>".$fila['nome_usuario']."</td>
                        <td>".$fila['email']."</td>
                        <td>".$fila['contrasinal']."</td>
                        <td>".$fila['rol']."</td>
                        <td>".$fila['data_rexistro']."</td>
                        <td>".$fila['data_conexion']."</td>
                        <td style='padding-top:15px;'>
                            <form method='post'>
                                <button type='submit' formaction='./modificar.php' name='modificarUsuario' value='{$fila['email']}'>Modificar</button>
                                <button type='submit' formaction='./verUsuarios.php' name='eliminarUsuario' value='{$fila['email']}'>Eliminar</button>
                            </form>
                        </td>
                    </tr>"; 
			}
			echo "</table>
                <p><br>
                    <form method='post'>
                        <p><button type='submit' formaction='./login.html'>Volver inicio</button></p>
                        <p><button type='submit' formaction='./pecharSesion.php' name='pecharSesion'>Pechar sesion</button></p>
                    </form>
                </p></center>";
    }

    function taboaMeuUser($mostrarMeuUser) {
        echo "<center><p><br><h1>Meu usuario</h1></p>";
        echo "<table border=1 style='border-collapse:collapse; text-align:center; width:1400px;'>
                    <tr>
                        <th>Nome de usuario</th>
                        <th>Email</th> 
                        <th>Contrasinal</th>
                        <th>Rol</th>
                        <th>Data rexistro</th>
                        <th>Ultima data conexión</th>
                    </tr>";
               while($fila=$mostrarMeuUser->fetch(PDO::FETCH_ASSOC)) { 
			   echo "<tr>
                        <td>".$fila['nome_usuario']."</td>
                        <td>".$fila['email']."</td>
                        <td>".$fila['contrasinal']."</td>
                        <td>".$fila['rol']."</td>
                        <td>".$fila['data_rexistro']."</td>
                        <td>".$fila['data_conexion']."</td>
                    </tr>"; 
			}
			echo "</table>
                <p><br>
                    <form method='post'>
                        <p><button type='submit' formaction='./login.html'>Volver inicio</button></p>
                        <p><button type='submit' formaction='./pecharSesion.php' name='pecharSesion'>Pechar sesion</button></p>
                    </form>
                </p></center>";
    }

    function mostrarListaUsers($conexionPDO) {
        try {
            $mostrarAllUsers = $conexionPDO->query("SELECT * FROM usuarios");
            taboaAllUsers($mostrarAllUsers);
        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $mostrarAllUsers = null;
        }
    }

    function mostrarMeuUser($conexionPDO) {
        try {
            $mostrarMeuUser = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $mostrarMeuUser->bindParam(':email', $_SESSION['usuarios']['email']);
            $mostrarMeuUser->execute();
            taboaMeuUser($mostrarMeuUser);
        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $mostrarMeuUser = null;
        }
    }

    function eliminarUser($conexionPDO, $emailUsuario) {
        try {
            $eliminarUser = $conexionPDO->prepare("DELETE FROM usuarios WHERE email = :email");
            $eliminarUser->bindParam(':email', $emailUsuario);
            $eliminarUser->execute();
            mensaxe("green","O usuario eliminouse correctamente");
        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $eliminarUser = null;
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=no_poo_repaso;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['verUsuarios_Admin'])) {
            mostrarListaUsers($conexionPDO);
        }
        if(isset($_POST['verUsuarios_User'])) {
            mostrarMeuUser($conexionPDO);
        }
        if(isset($_POST['eliminarUsuario'])) {
            eliminarUser($conexionPDO, $_POST['eliminarUsuario']);
        }
    } catch (PDOException $error) {
        die("Erro na consulta executada: " . $error->getMessage());
    }
    finally {
        $conexionPDO = null;
    }

?>