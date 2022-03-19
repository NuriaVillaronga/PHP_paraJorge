<?php
    if (!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_USER'] != "usuario") || ($_SERVER['PHP_AUTH_PW'] != "abc123.")) {
        header('WWW-Authenticate: Basic realm="Acceso restrinxido"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Requerida autenticación para acceder a esta páxina.';
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autenticación 2 http</title>
</head>
<body>
    <b>Conseguiches o acceso a zona restrinxida</b>
</body>
</html>