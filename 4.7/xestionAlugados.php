<?php session_start(); ?>

<?php

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try { 
                $verAlugados = $conexionPDO->query("SELECT * FROM aluga");
                    if ($verAlugados->rowCount() != 0)  {
                        echo "<center>
                              <h1>Xestión de alugados</h1>
                              <form method='get'>
                                <button formaction='./xestiona.php' name='volverXestiona'>Ir a paxina anterior</button>
                                <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                                <p><br>
                                <table border=1 style='width:1500px; border-collapse:collapse; text-align:center;'>
                                            <tr>
                                                <th>Producto</th> 
                                                <th>Email cliente</th>
                                                <th>Data Inicio</th> 
                                                <th>Data Fin</th>
                                                <th>Prezo aluga por día</th> 
                                                <th>Devolto</th>
                                            </tr>";
                            while($filaAluga=$verAlugados->fetch(PDO::FETCH_ASSOC)) {
                                $imaxesAlugados = $conexionPDO->prepare("SELECT * FROM producto WHERE idProducto = '{$filaAluga['idProductoAluga']}'");
                                $imaxesAlugados->execute();  

                                if ($imaxesAlugados->rowCount() != 0) {
                                    while($filaImaxe=$imaxesAlugados->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>
                                                <td><img src='./imaxes/".$filaImaxe['imaxe'].".png'></img></td>
                                                <td>".$filaAluga['emailCliente']."</td>
                                                <td>".$filaAluga['dataInicio']."</td>
                                                <td>".$filaAluga['dataFin']."</td>
                                                <td>".$filaAluga['prezoAluga']." €</td>";
                                                if ($filaAluga['devolto'] == "0") {
                                                    echo "<td>Non</td>";
                                                }
                                                if ($filaAluga['devolto'] == "1") {
                                                    echo "<td>Si</td>";
                                                }
                                        echo "</tr>";
                                    }
                                }
                            }
                        echo "</table>
                              </form>";
                    }
                    else {
                        echo "<center>
                                <h3 style='color:red;'>Non hay productos alugados<h3>
                                <p><br>
                                    <form method='get'>
                                        <button formaction='./xestiona.php' name='volverXestiona'>Ir a paxina anterior</button>
                                        <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                                    </form>
                                </p>
                              </center>";
                    }
                
            } catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $verAlugados = null;
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