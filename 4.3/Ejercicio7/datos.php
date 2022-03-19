<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rexistro de usuarios</title>
</head>
<body>

<?php

    if (isset($_GET['enviarDatos'])) {

        $hashedPassword = password_hash($_GET['contrasinal'], PASSWORD_DEFAULT); 

        try {
            $conexionPDO = new PDO("mysql:host=db-pdo;dbname=rexistro;charset=utf8mb4", "root", "root");
            $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            if (isset($_GET['enviarDatos'])) {
                if ($_GET['nome'] !== null and $_GET['contrasinal'] !== null) { 

                    try {
                        $existeUsuario = $conexionPDO->prepare("SELECT nome FROM usuarios WHERE nome = :nome");
                        $existeUsuario->bindParam(':nome', $_GET['nome']);
                        $existeUsuario->execute();

                        if($existeUsuario->rowCount() == 0) {

                            try {

                                $insertarUsuario = $conexionPDO->prepare("INSERT INTO usuarios (nome, contrasinal) VALUES (:nome, :contrasinal)");
                                $insertarUsuario->bindParam(':nome', $_GET['nome']);
                                $insertarUsuario->bindParam(':contrasinal', $hashedPassword);
                                $insertarUsuario->execute();

                                echo "Usuario rexistrado con éxito!";

                            } catch (PDOException $error) {
                                die("Erro na consulta executada: " . $error->getMessage());
                            }
                            finally {
                                $insertarUsuario = null;
                            } 
                        }
                        else {
                            echo "Este usuario xa está rexistrado!";
                        }

                    } catch (PDOException $error) {
                        die("Erro na consulta executada: " . $error->getMessage());
                    }
                    finally {
                        $existeUsuario = null;
                    }
                }
            }
        
        } catch (PDOException $error) {
            die("Erro na conexión coa base de datos: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }
    }
    else {
        echo "Tes que acceder mediante a páxina de <b>rexistro.php</b>";
    }
?>

</body>
</html>