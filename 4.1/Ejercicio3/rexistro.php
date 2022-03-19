<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rexistro novo</title>
</head>

<body>

  <form method="get">
      <p>Número: <input type="number" name="numero" size="20"></p>
      <p>Nome: <input type="text" name="nome" size="30"></p>
      <p>Numero de empregado asignado: <input type="number" name="numEmpregado" size="20"></p>
      <p>Limite de crédito: <input type="text" name="credito" size="20"></p>
      <p><button type="submit" formaction="./datos.php" name="rexistrar">Rexistrar</button></p>
  </form>

</body>
</html>