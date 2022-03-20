<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista</title>
</head>
<body>
    <center>
		<p>
			<form method="get">
				<p><br>
					<button type="submit" name="mostrarClientes">Mostrar clientes</button>
				</p>
				<p><br>
					<button type="submit" name="engadirCliente">Engadir cliente</button>
				</p>
				<p><br>
					<button type="submit" name="borrarCliente">Borrar cliente</button>
				</p>
				<p><br>
					<button type="submit" name="buscarEmail">Buscar cliente por email</button>
				</p>
				<p><br>
					<button type="submit" name="borrarEmail">Borrar cliente por email</button>
				</p>
				<p><br>
					<button type="submit" name="actualizarEmail">Actualizar cliente identificado por email</button>
				</p> 
			</form>
		</p>
	</center>

	<?php
		function mostrarClientes($arrayClientes) { 
			echo "<table border=1 style='border-collapse:collapse; text-align:center; width:600px;'>
                    <tr>
                        <th>Nome</th>
                        <th>Apelidos</th> 
                        <th>Email</th>
                    </tr>";
			foreach ($arrayClientes as $cliente) { 
			   echo "<tr>
                        <td>".$cliente['nome']."</td>
                        <td>".$cliente['apelidos']."</td>
                        <td>".$cliente['email']."</td>
                    </tr>"; 
			}
			echo "</table>";
		}

		function mostrarClientesEliminar($arrayClientes) { 
			echo "<form method='get'>";
				echo "<table border=1 style='border-collapse:collapse; text-align:center; width:600px;'>
						<tr>
							<th>Nome</th>
							<th>Apelidos</th> 
							<th>Email</th>
							<th>Accións</th>
						</tr>";
				foreach ($arrayClientes as $cliente) { 
				echo "<tr>
							<td>".$cliente['nome']."</td>
							<td>".$cliente['apelidos']."</td>
							<td>".$cliente['email']."</td>
							<td><button name='enviarEliminado' value=".$cliente['email'].">Eliminar</button></td>
						</tr>"; 
				}
				echo "</table>";
			echo "</form>";
		}

		function formularioRexistro() {
			echo "<form method='get'>
					 <p>Nome: <input type='text' name='nomeCliente'></p>  
					 <p>Apelidos: <input type='text' name='apelidosCliente'></p> 
					 <p>Email: <input type='email' name='emailCliente'></p>   
					 <p><br><button type='submit' name='enviarRexistro'>Enviar datos rexistro</button></p>
				  </form>";
		}

		function formularioEmail($nameInput, $nameButton) {
			echo "<form method='get'> 
					 <p>Email: <input type='email' name='{$nameInput}'></p>   
					 <p><br><button type='submit' name='{$nameButton}'>Enviar email</button></p>
				  </form>";
		}

		function formularioEmailBorrar() {
			formularioEmail("emailEliminar","enviarEmailEliminar");
		}

		function formularioEmailBuscar() {
			formularioEmail("emailBuscar","enviarEmailBuscar");
		}

		function formularioEmailActualizar() {
			formularioEmail("emailActualizar","enviarEmailActualizado");
		}

		function formularioActualizacion($arrayCliente) {
			foreach ($arrayCliente as $clienteActualizar) { 
				echo "<form method='get'>
						<p>Nome: <input type='text' name='nomeActualizado' placeholder='{$clienteActualizar['nome']}'></p>  
						<p>Apelidos: <input type='text' name='apelidosActualizados' placeholder='{$clienteActualizar['apelidos']}'></p>
						<p><br><button type='submit' name='actualizar'>Modificar</button></p>
					</form>";
			}
		}

		function mostrarMensaxe($mensaxe) {
			echo $mensaxe;
		}
	?>

</body>
</html>

