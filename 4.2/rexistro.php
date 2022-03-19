<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Palabra nova</title>
</head>

<body>

  <form action="diccionario.php" method="get">
      <p>Palabra galego: <input type="text" name="galego" size="20"></p>
      <p>Palabra ingles: <input type="text" name="ingles" size="30"></p>
      <p>
          <button type="submit" name="insertar">Insertar</button>
          <button type="submit" name="cancelar">Cancelar</button>
      </p>
  </form>

</body>
</html>