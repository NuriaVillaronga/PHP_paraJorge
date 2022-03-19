<?php session_start(); 

    function opcionsXestion($obterUsuarios) {
        echo "<center>
                <h1>Xestión de usuarios</h1>
                <form method='get'>
                    <button formaction='./xestiona.php' name='volverXestiona'>Ir a paxina anterior</button>
                    <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                    <p><br>
                    <table border=1 style='width:1500px; border-collapse:collapse; text-align:center;'>
                        <tr>
                            <th>Nome</th>
                            <th>Nome completo</th>
                            <th>Email</th>
                            <th>Contrasinal</th>
                            <th>Data de conexión</th>
                            <th>Rol</th> 
                        </tr>";
                while($fila=$obterUsuarios->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . $fila['nome'] . "</td>
                            <td>" . $fila['nomeCompleto'] . "</td>
                            <td>" . $fila['email'] . "</td>
                            <td>" . $fila['contrasinal'] . "</td>
                            <td>" . $fila['dataConexion'] . "</td>
                            <td>" . $fila['rol'] . "</td>
                        </tr>";
                }
            echo "</table>
                </form>
            </center>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try {
                
                $obterUsuarios = $conexionPDO->query("SELECT * FROM usuarios"); 
                opcionsXestion($obterUsuarios);

            } catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $obterUsuarios = null;
            }

    } catch (PDOException $error) {
        die("Erro na conexion coa base de datos: " . $error->getMessage());
    }
    finally {
        $conexionPDO = null;
    }

?>