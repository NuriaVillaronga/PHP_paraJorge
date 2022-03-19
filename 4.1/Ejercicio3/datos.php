<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mostrar datos</title>
</head>
<body>

<?php
    
    function obterDatos($sentencia) {
        echo "<table border=1 style='border-collapse:collapse; width:800px; text-align:center;'>
                <tr>
                    <th>Numero</th>
                    <th>Nome</th>
                    <th>Num empregado</th>
                    <th>Limite de crédito</th>
                </tr>";
        while($fila=$sentencia->fetch(PDO::FETCH_ASSOC)) 
            echo "<tr>
                    <td>" . $fila['numero'] . "</td>
                    <td>" . $fila['nome'] . "</td>
                    <td>" . $fila['num_empregado_asignado'] . "</td>
                    <td>" . $fila['limite_de_credito'] . "</td>
                  </tr>";
            echo "</table>";
    }

    function formularioAllUsers() {
        echo "<form method='get' action='./datos.php'>
                <button type='submit' name='ordenarEmpresa'>Ordenar por nome da empresa</button><br>
                <p><button type='submit' name='ordenarEmpregado'>Ordenar por empregado asignado</button></p>
            </form>";
    }

    function formularioExtraUserAna() {
        echo "<form method='get'>
                <p><button type='submit' formaction='./rexistro.php'>Engadir rexistro</button></p>
            </form>";
    }

    /**
    * Primer acceso á páxina --> almacenar datos en variable $_SESSION
    */
    if(isset($_GET['usuario'])) {
        if(($_GET['usuario'] === "Ana" || $_GET['usuario'] === "Xan") && $_GET['contrasinal'] === "abc123.") {
            $_SESSION['datos'] = ["nome" => $_GET['usuario'], "contrasinal" => $_GET['contrasinal']];
        }
        else {
            echo "Autenticación fallida";
        }
    }

    /**
    * Posteriores accesos á páxina --> O usuario xa accedeu unha vez polo que os seus datos están almacenados en $_SESSION
    */
    if(isset($_SESSION['datos'])) {

        echo "<p>O usuario da sesión é <b>".$_SESSION['datos']['nome']."</b> con contrasinal <b>".$_SESSION['datos']['contrasinal']."</b></p>";
        
        formularioAllUsers(); 

        if ($_SESSION['datos']['nome'] === "Ana" && $_SESSION['datos']['contrasinal'] === "abc123.") {
            formularioExtraUserAna();
        }

        try {
            $conexionPDO = new PDO("mysql:host=db-pdo;dbname=empresa;charset=utf8mb4", "root", "root");
            $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                try {
                    $ordenarEmpresa = $conexionPDO->query('SELECT * FROM cliente ORDER BY nome ASC');
                    $ordenarEmpregado = $conexionPDO->query('SELECT * FROM cliente ORDER BY num_empregado_asignado ASC');
                    
                    if (isset($_GET['ordenarEmpresa'])) {
                        echo "<h2>Datos ordenados por empresa</h2>";
                        obterDatos($ordenarEmpresa);
                    }
                    elseif (isset($_GET['ordenarEmpregado'])) {
                        echo "<h2>Datos ordenados por empregado</h2>";
                        obterDatos($ordenarEmpregado);
                    }
                    elseif (isset($_GET['rexistrar'])) {
                        if ($_SESSION['datos']['nome'] === "Ana" && $_SESSION['datos']['contrasinal'] === "abc123.") {
                            if ($_GET['numero'] > 0 and $_GET['numero'] !== null and $_GET['nome'] !== null) { 

                                try {
                                    $existeUsuario = $conexionPDO->prepare('SELECT numero FROM cliente WHERE numero= :numero');
                                    $existeUsuario->bindParam(':numero',$_GET['numero']);
                                    $existeUsuario->execute();

                                    if($existeUsuario->rowCount() == 0) //Se comprueba si el registro ya existe
                                    {
                                        try {
                                            $insertarUsuario = $conexionPDO->prepare('INSERT INTO cliente (numero, num_empregado_asignado, limite_de_credito, nome) VALUES (:numero, :numEmpregado, :credito, :nome)');

                                            $insertarUsuario->bindParam(':numero', $_GET['numero']);
                                            $insertarUsuario->bindParam(':numEmpregado', $_GET['numEmpregado']);
                                            $insertarUsuario->bindParam(':credito', $_GET['credito']);
                                            $insertarUsuario->bindParam(':nome', $_GET['nome']); 

                                            $insertarUsuario->execute();

                                            echo "Empresa rexistrada con éxito";

                                        } catch (PDOException $error) {
                                            die("Erro na consulta executada: " . $error->getMessage());
                                        }
                                        finally {
                                            $insertarUsuario = null;
                                        }
                                    }

                                } catch (PDOException $error) {
                                    die("Erro na consulta executada: " . $error->getMessage());
                                }
                                finally {
                                    $existeUsuario = null;
                                }
                            }
                        }
                        else {
                            echo "<p style='color:red;'>Tes que estar loggeado como <b>Ana</b> para poder efectuar un rexistro</p>";
                        }
                    }
                } catch (PDOException $error) {
                    die("Erro na consulta executada: " . $error->getMessage());
                }
                finally {
                    $ordenarEmpresa = null;
                    $ordenarEmpregado = null;
                }
        
        } catch (PDOException $error) {
            die("Erro na conexion coa base de datos: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }
    }
?>

</body>
</html>
