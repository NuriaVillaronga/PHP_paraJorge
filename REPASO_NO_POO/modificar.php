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

    function formularioModificar($datosUsuario) {
        $fila = $datosUsuario->fetch(PDO::FETCH_ASSOC);
        echo "<center>
            <h1>Modificación do usuario <u style='color:cadetblue;'>".$fila['nome_usuario']."</u></h1>
            <p>
                <br>
                <form method='post'>
                    <p>Nome de usuario: <input type='text' placeholder='".$fila['nome_usuario']."' name='user_name' size='30' required></p>
                    <p>
                        Rol: <select name='rol' required>
                            <option value='User'>User</option>
                            <option value='Admin'>Admin</option> 
                        </select>
                    </p>
                    <p>
                        <br>
                        <button type='submit' name='enviarModificacion' formaction='./modificar.php' value='".$fila['email']."'>Actualizar</button>
                    </p>
                </form>
                <form method='post'>
                    <br><button type='submit' formaction='./login.php'>Volver inicio</button>
                    <p><button type='submit' formaction='./pecharSesion.php' name='pecharSesion'>Pechar sesión</button></p>
                </form>
            </p>
        </center>";
    }

    function obterDatosUsuarioModificar($conexionPDO) {
        try {
            $datosUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $datosUsuario->bindParam(':email', $_POST['modificarUsuario']);
            $datosUsuario->execute();
            formularioModificar($datosUsuario);
        } catch(PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $datosUsuario = null; 
        }
    }

    function actualizarUsuario($conexionPDO) {
        try {
            $actualizarUsuario = $conexionPDO->prepare("UPDATE usuarios SET nome_usuario = :nome, rol = :rol WHERE email = :email");
            $actualizarUsuario->bindParam(':email', $_POST['enviarModificacion']);
            $actualizarUsuario->bindParam(':nome', $_POST['user_name']);
            $actualizarUsuario->bindParam(':rol', $_POST['rol']);
            $actualizarUsuario->execute();
            mensaxe("green","Usuario actualizado con éxito!");
        } catch(PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $actualizarUsuario = null;
        } 
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=no_poo_repaso;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['modificarUsuario'])) {
             obterDatosUsuarioModificar($conexionPDO);
        } 
        if(isset($_POST['enviarModificacion'])) {
            actualizarUsuario($conexionPDO);
        } 
        
    } catch(PDOException $error) {
        die("Erro na consulta executada: " . $error->getMessage());
    }
    finally {
        $conexionPDO = null;
    }

?>