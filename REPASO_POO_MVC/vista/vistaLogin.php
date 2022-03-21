<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggin</title>
</head>
<body>
    <center>
        <h1>Loggeate para acceder</h1>
        <p>
            <br>
            <form method="post">
                <p>Email: <input type="email" name="email" size="30" required></p>
                <p>Contrasinal: <input type="password" name="contrasinal" size="30" required></p>
                <p>
                    <br>
                    <button type="submit" name="loggin" formaction="../controlador/AccionsControlador.php">Loggin</button>
                </p>
            </form>
        </p>
    </center>
</body>
</html>

