<?php

require_once('../modelo/UsuarioModelo.php');

    if(isset($_POST['eliminarUsuario'])) {
        echo UsuarioModelo::eliminarUsuario($_POST['eliminarUsuario']);
    }

?>