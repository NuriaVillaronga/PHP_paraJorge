<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rexistro usuarios</title>
</head>

<body>

  <center>
		<h1>Rexistro de productos</h1>
        <form>
            <button formaction='./xestionProductos.php'>Ir a páxina anterior</button>
            <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
        </form>
		<p>
			<br>
			<form method="get">
                <br>
                <p>Nome: <input type='text' name='nomeProducto' size='30' required></p>
                <p>Descripcion: <textarea type='text' name='descripcionProducto'  required></textarea></p>
                <p>Prezo de aluga: <input type='text' name='prezoProducto' size='30' required></p> 
                <p>Imaxe: <input type='text' name='imaxeProducto' size='30' required></p>    
                <p>
					<br>
					<button type="submit" formaction="./rexistrarProducto.php" name="engadirProducto">Engadir producto</button>
				</p>
			</form>
		</p>
	</center>

<?php

    function mensaxeRexistro($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                </center>";
    }

    function insertarProducto($conexionPDO, $nome, $descripcion, $prezo, $imaxe) {
        try {
            $insertarProducto = $conexionPDO->prepare("INSERT INTO producto (nome, descripcion, prezoAluga, imaxe) VALUES (:nome, :descripcion, :prezo, :imaxe)");
            $insertarProducto->bindParam(':nome', $nome);
            $insertarProducto->bindParam(':descripcion', $descripcion);
            $insertarProducto->bindParam(':prezo', $prezo);
            $insertarProducto->bindParam(':imaxe', $imaxe);
                    
            $insertarProducto->execute();
            mensaxeRexistro("green","O producto foi rexistrado con éxito");
        }
        catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $insertarProducto = null; 
        }
    }

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['engadirProducto'])) {

            try {
                $existeProducto = $conexionPDO->prepare("SELECT * FROM producto WHERE nome = :nome");
                $existeProducto->bindParam(':nome', $_GET['nomeProducto']);
                $existeProducto->execute(); 

                if($existeProducto->rowCount() == 0)
                {
                    if (is_numeric($_GET['prezoProducto']) == true) {
                        insertarProducto($conexionPDO, $_GET['nomeProducto'], $_GET['descripcionProducto'], $_GET['prezoProducto'], $_GET['imaxeProducto']);
                    }
                    else {
                        mensaxeRexistro("red","Non se pode engadir o novo producto. O prezo debe de ser un número");
                    }
                }
                else {
                    mensaxeRexistro("red","O nome do producto que intentas engadir xa existe!");
                }
            } 
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $existeProducto = null;
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