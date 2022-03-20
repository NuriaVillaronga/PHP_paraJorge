<?php

function formularioActualizar($usuario) {
    echo "<center>
            <h1>Modificación do usuario <u style='color:cadetblue;'>".$usuario['nome_usuario']."</u></h1>
            <p>
                <br>
                <form method='post'>
                    <p>Nome de usuario: <input type='text' placeholder='".$usuario['nome_usuario']."' name='user_name' size='30' required></p>
                    <p>
                        Rol: <select name='user_rol' required>
                            <option value='User'>User</option>
                            <option value='Admin'>Admin</option> 
                        </select>
                    </p>
                    <p>
                        <br>
                        <button type='submit' name='enviarModificacion' value='".$usuario['email']."'>Actualizar</button>
                    </p>
                </form>
                <form method='post'>
                    <br><button type='submit' formaction='../controlador/LogginControlador.php'>Volver inicio</button>
                </form>
            </p>
        </center>";
}

?>