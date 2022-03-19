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

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['eliminarP'])) {

            try {
                $productoEliminar = $conexionPDO->prepare("DELETE FROM producto WHERE idProducto='{$_GET['eliminarP']}'");
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

        if(isset($_GET['modificarP'])) { 
            try {
                $producto = $conexionPDO->prepare("SELECT * FROM producto WHERE idProducto='{$_GET['modificarP']}'");
                $producto->execute(); 
                

                while($fila=$producto->fetch(PDO::FETCH_ASSOC)) {
                    echo "<center>
                            <h1>Modificar información productos</h1>
                            <form>
                                <button formaction='./xestionProductos.php'>Ir a páxina anterior</button>
                                <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                            </form>
                            <form method='get'> 
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

        if (isset($_GET['gardarModificacion'])) {

            if(is_numeric($_GET['prezoProducto']) == true) {     
                try {
                    $productoModificar = $conexionPDO->prepare("UPDATE producto SET nome = '{$_GET['nomeProducto']}', descripcion = '{$_GET['descripcionProducto']}', prezoAluga = '{$_GET['prezoProducto']}', imaxe = '{$_GET['imaxeProducto']}' WHERE idProducto='{$_GET['identificador']}'");
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