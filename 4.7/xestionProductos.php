<?php session_start(); 

    function opcionesXestion($obterProductos) {
        echo "<center>
                    <h1>Xestión de productos</h1>
                    <form method='get'>
                        <button formaction='./rexistrarProducto.php' name='rexistrarP'>Rexistrar novo producto</button>
                        <button formaction='./xestiona.php' name='volverXestiona'>Ir a paxina anterior</button>
                        <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                        <p><br>
                        <table border=1 style='width:1300px; border-collapse:collapse; text-align:center;'>
                            <tr>
                                <th style='width:250px;'>Nome</th>
                                <th style='width:300px;'>Descripcion</th>
                                <th style='width:250px;'>Prezo aluga</th>
                                <th style='width:300px;'>Imaxes</th>
                                <th>Accions</th>
                            </tr>";
                    while($fila=$obterProductos->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td style='width:250px;'><u>" . $fila['nome'] . "</u></td>
                                <td style='width:300px;'>" . $fila['descripcion'] . "</td>
                                <td style='width:250px;'>" . $fila['prezoAluga'] . " € </td>
                                <td style='width:300px;'><img src='./imaxes/".$fila['imaxe'].".png'></img></td>
                                <td>
                                    <button formaction='./modificarProducto.php' name='modificarP' value=".$fila['idProducto'].">Modificar producto</button>
                                    <p>
                                        <button formaction='./modificarProducto.php' name='eliminarP' value=".$fila['idProducto'].">Eliminar producto</button>
                                    </p>
                                </td>
                            </tr>";
                }
                echo "</table></p>
                    </form>
                </center>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $obterProductos = $conexionPDO->query("SELECT * FROM producto");
            opcionesXestion($obterProductos);
            
        } catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $obterProductos = null;
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