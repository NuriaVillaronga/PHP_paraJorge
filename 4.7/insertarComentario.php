<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rexistro comentarios</title>
</head>

<body>

<?php
    function mensaxeComentario($cor, $mensaxe) { 
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                </center>";
    }
?>

  <center>
		<h1>Rexistro de comentarios</h1>
        <form>
            <button formaction='./mostra.php'>Ir a páxina anterior</button>
            <p><button formaction="./pechaSesion.php" name="peche">Pechar sesión</button></p>
        </form>
		<p>
			<br>
			<form method="get">
                <br>
                <p>Comentario: <textarea type='text' name='comentarioProducto' required></textarea></p>  
                <p>
					<br>
					<button type="submit" formaction="./insertarComentario.php" name="engadirComentario">Engadir comentario</button>
				</p>
			</form>
		</p>
	</center>

<?php

    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['engadirComentario'])) { 

            date_default_timezone_set('Europe/Madrid');
            $dataComentario = date("Y-m-d H:i:s");

            try {
                $insertarComentario = $conexionPDO->prepare("INSERT INTO comentarios (emailComentario, comentario, dataComentario) VALUES 
                ('{$_SESSION['usuarios']['emailUsuario']}', '{$_GET['comentarioProducto']}', '$dataComentario')");
                                    
                $insertarComentario->execute();
                mensaxeComentario("green","O comentario foi rexistrado con éxito"); 
                
            } 
            catch (PDOException $error) {
                die("Erro na consulta executada: " . $error->getMessage());
            }
            finally {
                $insertarComentario = null;
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