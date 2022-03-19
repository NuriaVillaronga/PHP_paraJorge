<?php session_start(); 

    function formulario() {
        echo "<p><br>
                    <form method='get'>
                        <button formaction='./mostra.php'>Ir a paxina anterior</button>
                        <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                    </form>
                </p>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['verComentario'])) { 
            try {
                $comentarios = $conexionPDO->query("SELECT * FROM comentarios WHERE emailComentario='{$_SESSION['usuarios']['emailUsuario']}' ORDER BY dataComentario DESC");
                
                if ($comentarios->rowCount() != 0)  {
                    echo "<center>
                            <h1>Listaxe de comentarios de ".$_SESSION['usuarios']['nomeUsuario']."</h1>";
                            formulario();
                      echo "<table border=1 style='width:550px; border-collapse:collapse; text-align:center;'>
                                <tr>
                                    <th style='width:350px;'>Comentario</th>
                                    <th style='width:200px;'>Data comentario</th>
                                </tr>";

                        for ($i=$comentarios->rowCount(); $i>$comentarios->rowCount()-3; $i--) {
                            $fila = $comentarios->fetch(PDO::FETCH_ASSOC);
                            echo "<tr>
                                    <td style='width:350px;'>" . $fila['comentario'] . "</td>
                                    <td style='width:200px;'>" . $fila['dataComentario'] . "</td>
                                </tr>";
                        }
                        

                      echo "</table>";
                    echo "</center>";
                }
                else {
                    echo "<center>
                            <p><br>
                                <h3 style='color:red;'>Todavía non hai comentarios rexistrados<h3>
                            </p>";
                            formulario(); 
                    echo "</center>";
                }
            }
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $comentarios = null;
            }          
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