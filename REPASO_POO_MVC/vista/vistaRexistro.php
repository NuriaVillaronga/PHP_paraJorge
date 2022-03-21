<?php

    function formularioRexistro() {
        echo "<center>
                <h1>Rexistro de usuarios</h1>
                <p>
                    <br>
                    <form method='post'>
                        <p>Nome de usuario: <input type='text' name='nome_usuario' size='30' required></p>
                        <p>Email: <input type='email' name='email' size='30' required></p>
                        <p>Contrasinal: <input type='password' name='contrasinal' size='30' required></p>
                        <p>
                            Rol: <select name='rol' required>
                                <option value='User' selected>User</option>
                                <option value='Admin'>Admin</option> 
                            </select>
                        </p>
                        <p>
                            <br>
                            <button type='submit' name='enviarRexistro'>Rexistrar</button>
                        </p>
                    </form>
                    <form method='post'>
                        <br><button type='submit' formaction='../controlador/LogginControlador.php' name='inicio'>Volver ao inicio</button>
                    </form>
                </p>
            </center>"; 
    }
?>