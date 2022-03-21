<?php

    function opcionsAdmin() {
        echo "<center>
                <h1>Accións a realizar</h1>
                <p>
                    <br>
                    <form method='post'>
                        <p><button type='submit' formaction='../controlador/UsuariosControlador.php' name='verUsers_Admin'>Mostrar usuarios</button></p>
                        <p><button type='submit' formaction='../controlador/RexistroControlador.php' name='rexistrarUser'>Rexistrar usuario</button></p>
                        <p><button type='submit' formaction='../controlador/LogginControlador.php'>Volver inicio</button></p>
                        <p><button type='submit' formaction='../controlador/AccionsControlador.php' name='pecharSesion'>Pechar a sesion</button></p>
                    </form>
                </p>
            </center>";
    }

    function opcionsUser() {
		echo "<center>
				<h1>Accións a realizar</h1>
				<p>
					<br>
					<form method='post'>
						<p><button type='submit' formaction='../controlador/UsuariosControlador.php' name='verUsers_User'>Ver o meu usuario</button></p>
						<p><button type='submit' formaction='../controlador/LogginControlador.php'>Volver inicio</button></p>
                        <p><button type='submit' formaction='../controlador/AccionsControlador.php' name='pecharSesion'>Pechar a sesion</button></p>
					</form>
				</p>
			</center>";
	}

?>