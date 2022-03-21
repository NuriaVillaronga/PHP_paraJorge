<?php 
require_once('../modelo/UsuarioModelo.php');
require_once('../vista/vistaAccions.php');

    if(isset($_POST['loggin'])) {

        $rol = UsuarioModelo::obterRolUsuario($_POST['email'], $_POST['contrasinal']);
        
        if ($rol == "User") {
            opcionsUser();
        }
        if ($rol == "Admin") {
            opcionsAdmin();
        }
    }

    if (isset($_POST['pecharSesion'])) {
        UsuarioModelo::pecharSesion();
    }

?>