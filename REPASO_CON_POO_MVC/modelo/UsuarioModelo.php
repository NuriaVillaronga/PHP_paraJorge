<?php 
session_start();
include_once('Conexion.php');
include_once('Usuario.php');

class UsuarioModelo extends Usuario{

    public function __construct($nomeUser, $rol, $email, $contrasinal)
    {
        parent::__construct($nomeUser, $rol, $email, $contrasinal);
    }

    private static function mensaxe($cor, $mensaxe) : string {
        return "<center>
                    <p><br>
                        <h3 style='color:".$cor.";'>".$mensaxe."</h3>
                    </p>
                    <p><br>
                        <form method='post'><button type='submit' formaction='../controlador/LogginControlador.php' name='volverInicio'>Volver inicio</button></p>
                        </form>
                    </p>
                </center>";
    }

    public static function obterRolUsuario($email, $contrasinal) : string {

        $conexionPDO = new Conexion(); 

        try {
            $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $existeUsuario->bindParam(':email', $email);
            $existeUsuario->execute();

            if ($existeUsuario->rowCount() != 0) {
                while($fila=$existeUsuario->fetch(PDO::FETCH_ASSOC)) {
                    $contrasinalBD = $fila['contrasinal'];
                    $rol = $fila['rol'];
                }

                if (password_verify($contrasinal,$contrasinalBD)) {
                    $_SESSION['usuarios'] = ["emailUsuario" => $email, "contrasinal" => $contrasinal, "rol" => $rol];
                    $rolUsuario = $rol;
                }
                else {
                    die(UsuarioModelo::mensaxe("red","Non introduciches unha contrasinal correcta"));
                }
            }
            else {
                die(UsuarioModelo::mensaxe("red","O usuario co que te intentaches loggear non existe"));
            }

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $rolUsuario;
    }

    public static function mostrarUsuarios_User($email) : PDOStatement {

        $conexionPDO = new Conexion(); 

        try {
            $verMeuUsuario = $conexionPDO->query("SELECT * FROM usuarios WHERE email = '{$email}'");
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $verMeuUsuario;
    }

    public static function mostrarUsuarios_Admin() : PDOStatement {

        $conexionPDO = new Conexion(); 

        try {
            $verUsuarios = $conexionPDO->query("SELECT * FROM usuarios");
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $verUsuarios;
    }

    public static function obterDatosUsuarioModificar($email) : PDOStatement {
        $conexionPDO = new Conexion(); 

        try {
            $obterDatos = $conexionPDO->query("SELECT * FROM usuarios WHERE email = '{$email}'");
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $obterDatos;
    }

    public static function modificarUsuario($email, $nomeUsuario, $rol) : string {
        $conexionPDO = new Conexion(); 

        try {
            $actualizarUsuario = $conexionPDO->prepare("UPDATE usuarios SET nome_usuario = :nomeUsuario, rol = :rol WHERE email = :email");
            $actualizarUsuario->bindParam(':nomeUsuario', $nomeUsuario);
            $actualizarUsuario->bindParam(':rol', $rol);
            $actualizarUsuario->bindParam(':email', $email);
            $actualizarUsuario->execute();

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return UsuarioModelo::mensaxe("green", "O usuario foi modificado correctamente");
    }

    public static function eliminarUsuario($email) : string {

        $conexionPDO = new Conexion(); 

        try {
            $actualizarUsuario = $conexionPDO->prepare("DELETE FROM usuarios WHERE email = :email");
            $actualizarUsuario->bindParam(':email', $email);
            $actualizarUsuario->execute();

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return UsuarioModelo::mensaxe("green", "O usuario foi eliminado correctamente");
    }


    public static function rexistrarUsuario($nome, $email, $contrasinal, $rol) : string {
        $conexionPDO = new Conexion(); 

        try {
            $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
            $existeUsuario->bindParam(':email', $email);
            $existeUsuario->execute();

            if($existeUsuario->rowCount() != 0) {
                die(UsuarioModelo::mensaxe("red", "O usuario que intentaches rexistrar xa existe"));
            }
            else {
                $hashedPass = password_hash($contrasinal, PASSWORD_DEFAULT);
                
                $insertarUsuario = $conexionPDO->prepare("INSERT INTO usuarios (nome_usuario, email, contrasinal, rol) VALUES (:nome, :email, :contrasinal, :rol)");
                $insertarUsuario->bindParam(':email', $email);
                $insertarUsuario->bindParam(':nome', $nome);
                $insertarUsuario->bindParam(':rol', $rol);
                $insertarUsuario->bindParam(':contrasinal', $hashedPass);
                $insertarUsuario->execute();
            }

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return UsuarioModelo::mensaxe("green", "O usuario foi rexistrado con éxito");
    }
}