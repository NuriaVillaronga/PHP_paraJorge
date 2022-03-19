<?php session_start(); 

    function mensaxeErro() {
        echo "<center>
                <p><br>
                    <h3 style='color:red;'>Todavía non alugaches ningún producto<h3>
                </p>
                <p><br>
                    <form method='get'>
                        <button formaction='./mostra.php' name='volverMostra'>Ir a paxina anterior</button>
                        <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                    </form>
                </p>
            </center>";
    }

    function filasImaxeOpcions($conexionPDO, $filaAlugados) {
        try {
            $productos = $conexionPDO->prepare("SELECT * FROM producto WHERE idProducto = :id");
            $productos->bindParam(':id', $filaAlugados['idProductoAluga']);
            $productos->execute(); 

            if ($productos->rowCount() != 0) {
                while($filaImaxe=$productos->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td style='width:250px;'><img src='./imaxes/".$filaImaxe['imaxe'].".png'></img></td>
                            <td style='width:250px;'><button formaction='./reserva.php' name='devolverProducto' value=".$filaAlugados['idProducto'].">Devolver</button></td>
                        </tr>";
                }
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $productos = null;
        }
    }

    function verAlugados($conexionPDO, $alugados) {
        echo "<center>
                <h1>Productos alugados por <u>" . $_SESSION['usuarios']['nomeUsuario'] . "</u></h1>
                <form method='get'>
                    <button formaction='./mostra.php' name='volverMostra'>Ir a paxina anterior</button>
                    <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                    <p><br>
                    <table border=1 style='width:500px; border-collapse:collapse; text-align:center;'>
                        <tr>
                            <th style='width:250px;'>Producto</th>
                            <th style='width:250px;'>Accións</th>
                        </tr>";
                    while($filaAlugados=$alugados->fetch(PDO::FETCH_ASSOC)) {
                        filasImaxeOpcions($conexionPDO, $filaAlugados);
                    }
                echo "</table>
                </form>
            </center>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['verAlugados'])) { 
            try {
                $alugados = $conexionPDO->prepare("SELECT * FROM aluga WHERE emailCliente = :email AND devolto ='0'");
                $alugados->bindParam(':email', $_SESSION['usuarios']['emailUsuario']);
                $alugados->execute(); 

                if ($alugados->rowCount() != 0)  {
                    verAlugados($conexionPDO, $alugados);
                }
                else {
                    mensaxeErro(); 
                }
            }
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $alugados = null;
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