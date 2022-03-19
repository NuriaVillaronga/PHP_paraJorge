<?php

    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Acceso restrinxido"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Necesitase autorización para acceder a esta páxina.'; 
        exit;
    }
    else {
        $ficheiro = file("usuarios5.txt");
        
        $autenticacion = false; //Antes de hacer la validación el usuario no tendrá acceso
        
        for($i=0; $i < count($ficheiro); $i++) {

            $campoFicheiro = explode("?", $ficheiro[$i]); //Usuario e contrasinal separados por '?' 

            if (($_SERVER['PHP_AUTH_USER'] == $campoFicheiro[0]) && ($_SERVER['PHP_AUTH_PW'] == rtrim($campoFicheiro[1]))) {
                $autenticacion = true; //Tras hacer la validación el usuario tendrá acceso
            }

        }

        if (!$autenticacion) //Si no se autenticó ($autenticacion == false)
        {
            header('WWW-Authenticate: Basic realm="Acceso restrinxido"');
            header('HTTP/1.0 401 Unauthorized');
            echo  'Necesitase autorización para acceder a esta páxina.';
            exit; 
        }
        else {
?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Distintos usuarios en ficheiro de texto</title>
                </head>
                <body>
                    <br>Conseguiches o acceso a zona restrinxida co usuario <b><?php echo $_SERVER['PHP_AUTH_USER']; ?></b> e o contrasinal <b><?php echo $_SERVER['PHP_AUTH_PW'] ?></b>
                </body>
            </html>
<?php
        }
    }
?>