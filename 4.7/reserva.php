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

    function obterData() {
        date_default_timezone_set('Europe/Madrid');
        return date("Y-m-d H:i:s");
    }

    function obterPrezo($existeProducto) {
        while($fila=$existeProducto->fetch(PDO::FETCH_ASSOC)) {
            $prezoAluga = $fila['prezoAluga'];
        }
        return $prezoAluga;
    }
    
    function alugarProductoNuncaAlugado($conexionPDO, $idProducto, $email, $dataAluga, $prezoAluga) {
        try {
            $aluga = $conexionPDO->prepare("INSERT INTO aluga (idProductoAluga, emailCliente, dataInicio, dataFin, prezoAluga, devolto) VALUES (:id, :email, :dataAluga, NULL, :prezo, '0')");
            
            $aluga->bindParam(':id', $idProducto);
            $aluga->bindParam(':email', $email);
            $aluga->bindParam(':dataAluga', $dataAluga);
            $aluga->bindParam(':prezoAluga', $prezoAluga);

            $aluga->execute();
            mensaxeAluguer("green","Producto alugado con éxito!");
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $aluga = null;   
        } 
    }

    function alugarProductoDevolto($conexionPDO, $idProducto) {
        try {
            $dataAluga = obterData();
            $aluga = $conexionPDO->prepare("UPDATE aluga SET devolto = '0', dataInicio = :dataInicio , dataFin = NULL WHERE idProductoAluga = :id");
            $aluga->bindParam(':dataInicio', $dataAluga);
            $aluga->bindParam(':id', $idProducto);
            $aluga->execute();
            mensaxeAluguer("green","Producto alugado con éxito!"); 
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $aluga = null;  
        }
    }

    function devolverProducto($conexionPDO, $id){
        try {
            $dataDevolucion = obterData();
            $devolucion = $conexionPDO->prepare("UPDATE aluga SET devolto = '1', dataFin = :dataDevolucion WHERE idProductoAluga = :id");
            $devolucion->bindParam(':dataDevolucion', $dataDevolucion);
            $devolucion->bindParam(':id', $id);
            $devolucion->execute();
            mensaxeAluguer("green","Producto devolto con éxito!");
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $devolucion = null; 
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['alugarProducto'])) { 
            try {
                $productoAlugado = $conexionPDO->prepare('SELECT * FROM aluga WHERE idProductoAluga = :id');
                $productoAlugado->bindParam(':id', $_GET['alugarProducto']);
                $productoAlugado->execute();

                if($productoAlugado->rowCount() == 0) {
                    alugarProductoNuncaAlugado($conexionPDO, $_GET['alugarProducto'], $_SESSION['usuarios']['emailUsuario'], obterData(), obterPrezo($existeProducto));
                }
                if ($productoAlugado->rowCount() != 0) {

                    while($fila=$productoAlugado->fetch(PDO::FETCH_ASSOC)) {
                        
                        if ($fila['devolto'] == '0') {
                            mensaxeAluguer("red","O producto que seleccionaches xa está alugado!");
                        }      
                        if ($fila['devolto'] == '1') {
                            alugarProductoDevolto($conexionPDO, $_GET['alugarProducto']);
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

        if(isset($_GET['devolverProducto'])) { 
             devolverProducto($conexionPDO, $_GET['devolverProducto']);
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