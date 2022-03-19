<?php
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm='Acceso restrinxido'");
        header("HTTP/1.0 401 Unauthorized");
        die("Requerida autenticación para acceder a esta páxina.");
    }
    else {
        try {
            $conexionPDO = new PDO("mysql:host=db-pdo;dbname=rexistro;charset=utf8mb4", "root", "root");
            $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            try {
                $existeUsuario = $conexionPDO->prepare("SELECT contrasinal FROM usuarios WHERE nome = :nome"); 
                $existeUsuario->bindParam(':nome', $_SERVER['PHP_AUTH_USER']);
                $existeUsuario->execute();
    
                if($existeUsuario->rowCount() == 1) {
                    $fila = $existeUsuario->fetch(); 
                    $contrasinalBD = $fila[0];
                    $contrasinalIntroducido = $_SERVER['PHP_AUTH_PW']; 
                }

                if ($existeUsuario->rowCount() == 0 || !password_verify($contrasinalIntroducido, $contrasinalBD)) {
                    header("WWW-Authenticate: Basic realm='Acceso restrinxido'");
                    header("HTTP/1.0 401 Unauthorized");
                    $existeUsuario = null;
                    $conexionPDO = null;
                    die("Requerida autenticación para acceder a esta páxina.");
                }
    
            } catch (PDOException $error) {
                die("Erro recuperando os datos da BD: " . $ex->getMessage());
            }
            finally {
                $existeUsuario = null;
            }
        } 
        catch (PDOException $error) {
            die("Erro na conexión coa base de datos: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autenticación 8 con password_verify</title>
</head>
<body>
    <p><?php echo "Benvido <b>{$_SERVER['PHP_AUTH_USER']}</b>, conseguiches acceso á área restrinxida"; ?></p>
</body>
</html>