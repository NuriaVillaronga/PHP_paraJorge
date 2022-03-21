<?php

require_once('../modelo/UsuarioModelo.php');
require_once('../vista/vistaUsuarios.php');

    if(isset($_POST['verUsers_Admin'])) {
        $usuarios = UsuarioModelo::mostrarUsuarios_Admin();

        while($fila = $usuarios->fetch(PDO::FETCH_ASSOC)) {
            $arrayUsuarios[]= $fila; 
        }
        verUsuarios_Admin($arrayUsuarios);
    }

    if (isset($_POST['verUsers_User'])){
        $usuarios = UsuarioModelo::mostrarUsuarios_User($_SESSION['usuarios']['emailUsuario']);

        while($fila = $usuarios->fetch(PDO::FETCH_ASSOC)) {
            $arrayUsuarios[]= $fila; 
        }
        verUsuarios_User($arrayUsuarios);
    }

?>