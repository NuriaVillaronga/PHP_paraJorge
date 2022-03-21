<?php

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

    function formularioRexistro() {
        echo "<center>
                <h1>Rexistro de usuarios</h1>
                <p>
                    <br>
                    <form method='post'>
                        <p>Nome de usuario: <input type='text' name='nome_usuario' size='30' required></p>
                        <p>Email: <input type='email' name='email' size='30' required></p>
                        <p>Contrasinal: <input type='password' name='contrasinal' size='30' required></p>
                        <p>
                            Rol: <select name='rol' required>
                                <option value='User' selected>User</option>
                                <option value='Admin'>Admin</option> 
                            </select>
                        </p>
                        <p>
                            <br>
                            <button type='submit' formaction='./rexistro.php' name='enviarRexistro'>Rexistrar</button>
                        </p>
                    </form>
                    <form method='post'>
                        <br><button type='submit' formaction='./login.html'>Volver ao inicio</button>
                        <p><button type='submit' formaction='./pecharSesion.php' name='pecharSesion'>Pechar sesión</button></p>
                    </form>
                </p>
            </center>";
    }

    function insertarUsuario($conexionPDO) {
        try {
            date_default_timezone_set('Europe/Madrid');
            $dataRexistro = date("Y-m-d H:i:s"); 
            $hashedPass = password_hash($_POST['contrasinal'], PASSWORD_DEFAULT);

            $insertarUsuario = $conexionPDO->prepare("INSERT INTO usuarios (nome_usuario, email, contrasinal, rol, data_rexistro, data_conexion) VALUES (:nome, :email, :contrasinal, :rol, :rexistro, NULL)");
            $insertarUsuario->bindParam(':nome',$_POST['nome_usuario']);
            $insertarUsuario->bindParam(':email',$_POST['email']);
            $insertarUsuario->bindParam(':contrasinal',$hashedPass);
            $insertarUsuario->bindParam(':rexistro',$dataRexistro);
            $insertarUsuario->bindParam(':rol',$_POST['rol']);
            $insertarUsuario->execute();

            mensaxe("green","Usuario rexistrado con éxito!");
        } catch(PDOException $error) {
            die("Erro na consulta executada " . $error->getMessage());
        }
        finally {
            $insertarUsuario = null;
        }
    }

    function rexistrar_comprobacion_inserccion($conexionPDO) {
        try {
            $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $existeUsuario->bindParam(':email', $_POST['email']);
            $existeUsuario->execute();
            if ($existeUsuario->rowCount() != 0) {
                mensaxe("red","O usuario que intentas rexistrar xa existe!");
            }
            else {
                insertarUsuario($conexionPDO);
            }
        } catch(PDOException $error) {
            die("Erro na consulta executada " . $error->getMessage());
        }
        finally {
            $existeUsuario = null;
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=no_poo_repaso;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
        if(isset($_POST['rexistrarUser'])) {
            formularioRexistro();
        }
        if(isset($_POST['enviarRexistro'])) {
            rexistrar_comprobacion_inserccion($conexionPDO);
        }
    } catch(PDOException $error) {
        die("Erro na consulta executada " . $error->getMessage());
    }
    finally {
        $conexionPDO = null;
    }
?>