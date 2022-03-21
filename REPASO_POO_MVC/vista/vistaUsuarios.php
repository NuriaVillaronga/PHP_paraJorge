<?php

    function verUsuarios_User($arrayUsuarios) {
        echo "<center><p><br><h1>Mi usuario</h1></p>";
        echo "<table border=1 style='border-collapse:collapse; text-align:center; width:1000px;'>
                    <tr>
                        <th>Nome de usuario</th>
                        <th>Email</th> 
                        <th>Contrasinal</th>
                        <th>Rol</th>
                    </tr>";
			foreach ($arrayUsuarios as $usuario) { 
			   echo "<tr>
                        <td>".$usuario['nome_usuario']."</td>
                        <td>".$usuario['email']."</td>
                        <td>".$usuario['contrasinal']."</td>
                        <td>".$usuario['rol']."</td>
                    </tr>"; 
			}
			echo "</table>
                <p><br>
                    <form method='post'>
                        <p><button type='submit' formaction='../controlador/LogginControlador.php'>Volver inicio</button></p>
                    </form>
                </p></center>";
    }

    function verUsuarios_Admin($arrayUsuarios) {
        echo "<center><p><br><h1>Listaxe de usuarios</h1></p>";
        echo "<table border=1 style='border-collapse:collapse; text-align:center; width:1100px;'>
                    <tr>
                        <th>Nome de usuario</th>
                        <th>Email</th> 
                        <th>Contrasinal</th>
                        <th>Rol</th>
                        <th>Accións</th>
                    </tr>";
			foreach ($arrayUsuarios as $usuario) { 
			   echo "<tr>
                        <td>".$usuario['nome_usuario']."</td>
                        <td>".$usuario['email']."</td>
                        <td>".$usuario['contrasinal']."</td>
                        <td>".$usuario['rol']."</td>
                        <td style='padding-top:15px;'>
                            <form method='post'>
                                <button type='submit' formaction='../controlador/ModificarControlador.php' name='modificarUsuario' value='{$usuario['email']}'>Modificar</button>
                                <button type='submit' formaction='../controlador/EliminarControlador.php' name='eliminarUsuario' value='{$usuario['email']}'>Eliminar</button>
                            </form>
                        </td>
                    </tr>"; 
			}
			echo "</table>
                <p><br>
                    <form method='post'>
                        <p><button type='submit' formaction='../controlador/LogginControlador.php'>Volver inicio</button></p>
                    </form>
                </p></center>";
    }

?>