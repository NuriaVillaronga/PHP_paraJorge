<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mostrar datos</title>
</head>
<body>

<?php
    
    function obterDatos($sentencia) {
        echo "<table border=1 style='border-collapse:collapse;'>
                <tr>
                    <th>Usuario</th>
                    <th>Comentarios</th>
                </tr>";
        while($fila=$sentencia->fetch(PDO::FETCH_ASSOC)) 
            echo "<tr>
                    <td>" . $fila['usuario'] . "</td>
                    <td>" . $fila['comentarios'] . "</td>
                  </tr>";
            echo "</table>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=usuariosXSS;charset=utf8mb4", "root", "root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        try {
            $listaxeUsuarios = $conexionPDO->query('SELECT * FROM rexistro ORDER BY usuario ASC');
            obterDatos($listaxeUsuarios);

        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $listaxeUsuarios = null;
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