<?php session_start(); 

    function botonsFormulario() {
        echo "<p><br>
                <form method='get'>
                    <button formaction='./mostra.php'>Ir a paxina anterior</button>
                    <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                </form>
            </p>";
    }
    function mensaxe($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                ".botonsFormulario()."
                </center>";
    }

    function listaComentarios($comentarios) {
        echo "<center>
                <h1>Listaxe de comentarios de ".$_SESSION['usuarios']['nomeUsuario']."</h1>";
                botonsFormulario();
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

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['verComentario'])) { 
            try {
                $comentarios = $conexionPDO->prepare("SELECT * FROM comentarios WHERE emailComentario = :email ORDER BY dataComentario DESC");
                $comentarios->bindParam(':email', $_SESSION['usuarios']['emailUsuario']);
                $comentarios->execute();
                
                if ($comentarios->rowCount() != 0)  {
                    listaComentarios($comentarios);
                }
                else {
                    mensaxe("red", "Todavía non hai comentarios rexistrados");
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