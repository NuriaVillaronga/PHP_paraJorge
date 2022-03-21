<?php

require_once('../modelo/UsuarioModelo.php');
require_once('../vista/vistaRexistro.php');

    if(isset($_POST['rexistrarUser'])) {
        formularioRexistro();
    }

    if(isset($_POST['enviarRexistro'])) {
        echo UsuarioModelo::rexistrarUsuario($_POST['nome_usuario'],$_POST['email'],$_POST['contrasinal'],$_POST['rol']);
    }

?>