<?php session_start();

    function cookies($sesion) {
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

    //Primer acceso a través de loggin
    try {
        $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['loggin'])) {
            if ($_GET['emailLogin'] != null and $_GET['contrasinalLogin'] != null) {
                
                try {
                    $existeUsuario = $conexionPDO->prepare("SELECT * FROM usuarios WHERE email='{$_GET['emailLogin']}'");
                    $existeUsuario->execute();

                    if ($existeUsuario->rowCount() != 0)  {
                        $nome = null;
                        $rol = null;
                        $contrasinal = null;
                        while($fila=$existeUsuario->fetch(PDO::FETCH_ASSOC)) {
                            $contrasinal = $fila['contrasinal'];
                            $nome = $fila['nome'];
                            $rol = $fila['rol'];
                        }

                        if (password_verify($_GET['contrasinalLogin'],$contrasinal)) {

                            //¿¿¿¿ Evitar fixación de sesións ????
                            if (!isset($_SESSION['usuarios'])) {
                                session_regenerate_id(true);
                                $_SESSION['usuarios']= true;
                            }
                            //-------------

                            //Creacion do array session de usuarios
                            $_SESSION['usuarios'] = ["emailUsuario"=>$_GET['emailLogin'], "contrasinal"=>$_GET['contrasinalLogin'],"nomeUsuario"=>$nome, "rol"=>$rol];
                            cookies($_SESSION['usuarios']['nomeUsuario']);
                        }
                        else {
                            die(mensaxeErrro("red","Non introduciches unha contrasinal correcta"));
                        }
                    }
                        
                } catch (PDOException $error) {
                    die("Erro na consulta executada: " . $error->getMessage());
                }
                finally {
                    $existeUsuario = null;
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

    //Posteriores accesos
    if(isset($_SESSION['usuarios'])) {

        if ($_SESSION['usuarios']['rol'] == "Admin") {
            header('Location: ./xestiona.php');
        }

        if ($_SESSION['usuarios']['rol'] == "User") {
            
            cookies($_SESSION['usuarios']['nomeUsuario']);
            
            try {
                $conexionPDO = new PDO("mysql:host=db-pdo;dbname=tarefa;charset=utf8mb4","root","root");
                $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                    try {
                        $obterProductos = $conexionPDO->query("SELECT * FROM producto");
                        echo "<center>";
                                if(!empty($_COOKIE) ) {
                                    foreach ($_COOKIE as $key=>$value) {
                                        if ($key == "Saludo") {
                                            echo "<h2 style='color:#67009B;'><u>".$value."</u></h2>";
                                        }
                                    }
                                }
                                else {
                                    echo "<h3 style='color:red;'>Todavía non hai cookies creadas</h3>";
                                }
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
        }   
    }
?>

</body>
</html>