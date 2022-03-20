<?php

require_once('../modelo/UsuarioModelo.php');
require_once('../vista/vistaModificar.php');

    if(isset($_POST['modificarUsuario'])) {
        $usuarioActualizar = UsuarioModelo::obterDatosUsuarioModificar($_POST['modificarUsuario']);

        while($fila = $usuarioActualizar->fetch(PDO::FETCH_ASSOC)) {
            $usuario = $fila;
        }
        formularioActualizar($usuario);
    }

    if(isset($_POST['enviarModificacion'])) {
        echo UsuarioModelo::modificarUsuario($_POST['enviarModificacion'],$_POST['user_name'], $_POST['user_rol']);
    }

?>