<?php session_start();

    function setSaudoCookie($sesion) {
        if (isset($_GET['idioma'])) {
            if ($_GET['idioma'] == "castelan") {
                setcookie("Saludo","Bienvenido ".$sesion);
            }
            if ($_GET['idioma'] == "galego") {
                setcookie("Saludo","Benvido ".$sesion);
            }
            if ($_GET['idioma'] == "ingles") {
                setcookie("Saludo","Welcome ".$sesion); 
            }
        }
    }

    function crearSesionUsuario($existeUsuario) {
        while($fila=$existeUsuario->fetch(PDO::FETCH_ASSOC)) {
            $contrasinalBD = $fila['contrasinal'];
            $nomeBD = $fila['nome'];
            $rolBD = $fila['rol'];
        }

        if (password_verify($_GET['contrasinalLogin'],$contrasinalBD)) {
            $_SESSION['usuarios'] = ["emailUsuario" => $_GET['emailLogin'], "contrasinal" => $_GET['contrasinalLogin'], "nomeUsuario" => $nomeBD, "rol" => $rolBD];
            setSaudoCookie($_SESSION['usuarios']['nomeUsuario']);
        }
        else {
            die(mensaxeErrro("red","Non introduciches unha contrasinal correcta"));
        }
    }

    function amosarSaudoCookie() {
        if(!empty($_COOKIE)) {
            foreach ($_COOKIE as $key=>$value) {
                if ($key == "Saludo") {
                    echo "<h2 style='color:#67009B;'><u>".$value."</u></h2>";
                }
            }
        }
        else {
            echo "<h3 style='color:red;'>Non hai saudo porque todavía non hai cookies creadas</h3>";
        }
    }

    function mensaxeErrro($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
                <p><br>
                    <form method='get'>
                        <button formaction='./login.php'>Volver a paxina de inicio</button> 
                        <p><button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button></p>
                    </form>
                </p>
              </center>";
    }

    function listaProductosOfertados($obterProductos) {
        echo "<h1>Listaxe de productos ofertados</h1>
              <form method='get'>
                    <button formaction='./verComentarios.php'  name='verComentario'>Ver comentarios</button>
                    <button formaction='./insertarComentario.php'>Facer comentario</button>
                    <button formaction='./login.php' name='volverInicio'>Volver ao inicio</button>
                    <button formaction='./pechaSesion.php' name='peche'>Pechar sesión</button>
                    <p><br>
                    <table border=1 style='width:1200px; border-collapse:collapse; text-align:center;'>
                        <tr>
                            <th style='width:250px;'>Nome</th>
                            <th style='width:300px;'>Descripcion</th>
                            <th style='width:250px;'>Prezo aluga por día</th>
                            <th style='width:300px;'>Imaxes</th>
                            <th>Accions</th>
                        </tr>";
                while($fila=$obterProductos->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td style='width:250px;'><u>" . $fila['nome'] . "</u></td>
                            <td style='width:300px;'>" . $fila['descripcion'] . "</td>
                            <td style='width:250px;'>" . $fila['prezoAluga'] . " € </td>
                            <td style='width:300px;'><img src='./imaxes/".$fila['imaxe'].".png'></img></td>
                            <td><button formaction='./reserva.php' name='alugarProducto' value=".$fila['idProducto'].">Alugar</button></td>
                        </tr>";
                }
              echo "</table>
              </form>";                         
    }

    
    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['loggin'])) {
            if ($_GET['emailLogin'] != null and $_GET['contrasinalLogin'] != null) {
                
                /**
                * Primer acceso á páxina --> almacenar datos en variable $_SESSION
                */
                try {
                    $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email = :email");
                    $existeUsuario->bindParam(':email', $_GET['emailLogin']);
                    $existeUsuario->execute();

                    if ($existeUsuario->rowCount() != 0)  {
                        crearSesionUsuario($existeUsuario);
                    }
                        
                } catch (PDOException $error) {
                    die("Erro na consulta executada: " . $error->getMessage());
                }
                finally {
                    $existeUsuario = null;
                } 

                /**
                * Posteriores accesos á páxina --> O usuario xa accedeu unha vez polo que os seus datos están almacenados en $_SESSION
                */
                if(isset($_SESSION['usuarios'])) {

                    if ($_SESSION['usuarios']['rol'] == "Admin") {
                        header('Location: ./xestiona.php');
                    }

                    if ($_SESSION['usuarios']['rol'] == "User") {
                        
                        try {
                            $obterProductos = $conexionPDO->query("SELECT * FROM producto");
                            echo "<center>";
                                    amosarSaudoCookie();
                                    listaProductosOfertados($obterProductos);
                            echo "</center>";
                            
                        } catch (PDOException $error) {
                            die("Erro na consulta executada: " . $error->getMessage());
                        }
                        finally {
                            $obterProductos = null;
                        }
                    }   
                }          
            }
            else {
                die(mensaxeErrro("red","Os campos de acceso a loggin non poden estar baleiros"));
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