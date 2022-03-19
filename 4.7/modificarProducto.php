<?php session_start(); 

    function mensaxeModificacion($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                <p><br>
                    <form method='get'>
                        <button formaction='./xestionProductos.php' name='volverXestionaP'>Ir a páxina anterior</button> 
                        <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                    </form>
                </p>
                </center>";
    }

    function eliminarProducto($conexionPDO, $id) {
        try {
            $productoEliminar = $conexionPDO->prepare("DELETE FROM producto WHERE idProducto = :id");
            $productoEliminar->bindParam(':id', $id);
            $productoEliminar->execute();
            mensaxeModificacion("green","Producto eliminado con éxito!"); 
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $productoEliminar = null; 
        }
    }

    function formularioProductoModificar($conexionPDO, $id) {
        try {
            $producto = $conexionPDO->prepare("SELECT * FROM producto WHERE idProducto = :id");
            $producto->bindParam(':id', $id);
            $producto->execute(); 
            
            while($fila=$producto->fetch(PDO::FETCH_ASSOC)) {
                echo "<center>
                        <h1>Modificar información productos</h1>
                        <form method='get'>
                            <button formaction='./xestionProductos.php'>Ir a páxina anterior</button>
                            <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                        <p>
                            <br>
                            <input style='display:none;' type='text' name='identificador' value=".$fila['idProducto'].">
                            <p>Nome: <input type='text' name='nomeProducto' placeholder='".$fila['nome']."' size='30' required></p>
                            <p>Descripcion: <textarea type='text' name='descripcionProducto' placeholder='".$fila['descripcion']."' required></textarea></p>
                            <p>Prezo de aluga: <input type='text' name='prezoProducto' placeholder=".$fila['prezoAluga']." size='30' required></p> 
                            <p>Imaxe: <input type='text' name='imaxeProducto' placeholder=".$fila['imaxe']." size='30' required></p>    
                            <p>
                                <br>
                                <button type='submit' formaction='./modificarProducto.php' name='gardarModificacion'>Modificar</button>
                            </p>
                        </form>
                        </p>
                    </center>";
            }
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $producto = null;
        }
    }

    function modificarProducto($conexionPDO, $nome, $descripcion, $prezo, $imaxe, $id) {
        try {
            $productoModificar = $conexionPDO->prepare("UPDATE producto SET nome = :nome, descripcion = :descripcion, prezoAluga = :prezo, imaxe = :imaxe WHERE idProducto = :id");
            $productoModificar->bindParam(':nome', $nome);
            $productoModificar->bindParam(':descripcion', $descripcion);
            $productoModificar->bindParam(':prezo', $prezo);
            $productoModificar->bindParam(':imaxe', $imaxe);
            $productoModificar->bindParam(':id', $id);
            $productoModificar->execute();
            mensaxeModificacion("green","Producto modificado con éxito!"); 
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $productoModificar = null; 
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['eliminarP'])) {
            eliminarProducto($conexionPDO, $_GET['eliminarP']);
        }
        if(isset($_GET['modificarP'])) { 
            formularioProductoModificar($conexionPDO, $_GET['modificarP']);
        }

        if (isset($_GET['gardarModificacion'])) {
            if(is_numeric($_GET['prezoProducto']) == true) {     
                modificarProducto($conexionPDO, $_GET['nomeProducto'], $_GET['descripcionProducto'], $_GET['prezoProducto'], $_GET['imaxeProducto'], $_GET['identificador']);
            }
            else {
                mensaxeModificacion("red","O producto non se puido modificar. O prezo ten que ser numérico!");
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