<?php session_start(); 

    function mensaxeAluguer($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                <p><br>
                    <form method='get'>
                        <button formaction='./verAlugados.php' name='verAlugados'>Ver productos alugados</button>
                        <button formaction='./mostra.php' name='volverMostra'>Ir a paxina anterior</button>
                        <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                    </form>
                </p>
                </center>";
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['alugarProducto'])) { 
            try {
                $producto = $conexionPDO->prepare("SELECT * FROM producto WHERE idProducto='{$_GET['alugarProducto']}'");
                $producto->execute(); 

                if ($producto->rowCount() != 0)  {
                          
                    date_default_timezone_set('Europe/Madrid');
                    $dataAluga = date("Y-m-d H:i:s");

                    $prezoAluga = null;
                    while($fila=$producto->fetch(PDO::FETCH_ASSOC)) {
                        $prezoAluga = $fila['prezoAluga'];
                    }

                    try {
                        $productoAlugado = $conexionPDO->prepare("SELECT * FROM aluga WHERE idProductoAluga='{$_GET['alugarProducto']}'");
                        $productoAlugado->execute();

                        if($productoAlugado->rowCount() == 0)
                        {
                            try {
                                $insertarProducto = $conexionPDO->prepare("INSERT INTO aluga (idProductoAluga, emailCliente, dataInicio, dataFin, prezoAluga, devolto) VALUES 
                                                                            ('{$_GET['alugarProducto']}', '{$_SESSION['usuarios']['emailUsuario']}', '$dataAluga', NULL, '$prezoAluga', '0')");
                                    
                                $insertarProducto->execute();
                                mensaxeAluguer("green","Producto alugado con éxito!");
                            }
                            catch (PDOException $error) {
                                die("Erro na consulta executada: " . $error->getMessage());
                            }
                            finally {
                                $insertarProducto = null;
                            } 
                        }
                        if ($productoAlugado->rowCount() != 0) {

                            while($fila=$productoAlugado->fetch(PDO::FETCH_ASSOC)) {
                                if ($fila['devolto'] == '0') {
                                    mensaxeAluguer("red","O producto que seleccionaches xa está alugado!");
                                }
                                        
                                if ($fila['devolto'] == '1') {
                                    try {
                                        $alugarProducto = $conexionPDO->query("UPDATE aluga SET devolto = '0', dataFin = NULL WHERE idProductoAluga='{$_GET['alugarProducto']}'");
                                        mensaxeAluguer("green","Producto alugado con éxito!"); 
                                    }
                                    catch (PDOException $error) {
                                        die("Erro na consulta executada: " . $error->getMessage());
                                    }
                                    finally {
                                        $alugarProducto = null;
                                    }
                                }
                            }
                        }
                    }
                    catch (PDOException $error) {
                        die("Erro na consulta executada: " . $error->getMessage());
                    }
                    finally {
                        $productoAlugado = null;
                    }
                }
            }
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $producto = null;
            }          
        }


        if(isset($_GET['devolverProducto'])) { 
            
            date_default_timezone_set('Europe/Madrid');
            $dataFin = date("Y-m-d H:i:s");
                    
            try {
                $productoDevolver = $conexionPDO->query("UPDATE aluga SET devolto = '1', dataFin = '{$dataFin}' WHERE idProductoAluga='{$_GET['devolverProducto']}'");
                mensaxeAluguer("green","Producto devolto con éxito!");
            }
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $productoDevolver = null;
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