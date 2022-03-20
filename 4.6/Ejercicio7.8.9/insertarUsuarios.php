<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insertar usuarios</title>
</head>
<body>

<?php

    function existeUsuario($conexionPDO, $usuario) {
        return $conexionPDO->prepare("SELECT usuario FROM rexistro WHERE usuario=$usuario");
    }

    function insertarUsuario($conexionPDO, $existeUsuario, $usuario, $comentarios) { 
        if($existeUsuario->rowCount() == 0) {
            $insertarUsuario = $conexionPDO->prepare("INSERT INTO rexistro (usuario, comentarios) VALUES ('$usuario', '$comentarios')");
            $insertarUsuario->execute();
        }
    }

        try {
            $conexionPDO = new PDO("mysql:host=db-pdo;dbname=usuariosXSS;charset=utf8mb4", "root", "root");
            $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                try {
                    $usuario1 = "nuria";
                    $comentarios1 = "O usuario rexistrado chámase Nuria Villaronga e ten 23 anos";
                    $usuario2 = "dalila";
                    $comentarios2 = "O usuario rexistrado chámase Dalila Villaronga e ten 2 anos";
                    $usuario3 = "xura";
                    $comentarios3 = "O usuario rexistrado chámase Xura Villaronga e ten 1 ano";
                    
                    insertarUsuario($conexionPDO, existeUsuario($conexionPDO, $usuario1), $usuario1, $comentarios1);
                    insertarUsuario($conexionPDO, existeUsuario($conexionPDO, $usuario2), $usuario2, $comentarios2);
                    insertarUsuario($conexionPDO, existeUsuario($conexionPDO, $usuario3), $usuario3, $comentarios3);

                    echo "A inserccion de datos foi realizada con éxito";
?>
                    <form action="mostra.php" method="get">
                        <p><button type="submit" name="visualizar">Visualizar os datos</button></p>
                    </form>
<?php                          
                } catch (PDOException $error) {
                    die("Erro na consulta executada: " . $error->getMessage());
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
