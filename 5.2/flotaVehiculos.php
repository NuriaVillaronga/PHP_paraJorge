<?php 
include 'vehiculo.php'; 
session_start();
/*
session_unset();
session_destroy();
*/
?>

    <center>
		<h1>Rexistro de vehículos</h1>
		<p>
			<br>
			<form method="get" action="./flotaVehiculos.php">
				<p>Modelo: <input type="text" name="modelo" size="30" required></p>
				<p>Matrícula: <input type="text" name="matricula" size="30" required></p>
                <p>Kms: <input type="text" name="kms" size="30" required></p>
				<p>
					<br>
					<button type="submit" name="engadir">Engadir vehiculo</button>
				</p>
			</form>
		</p>
	</center>

<?php

    function mensaxeErro($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
            </center>";
    }

    if (isset($_GET['engadir'])) {
        if (is_numeric($_GET['kms']) == true) {
            $_SESSION['flota'][] = new Vehiculo($_GET['matricula'],$_GET['modelo'],$_GET['kms']);
        }
        else {
            mensaxeErro("red","Nos kms debes introducir un número válido");
        }
    }

    if (empty($_SESSION['flota']) == false) {
        
        echo "<center><h1>Listaxe de vehículos</h1>
                <table border=1 style='border-collapse:collapse; width:600px; text-align:center;'>
                    <tr>
                        <th>Matrícula</th>
                        <th>Modelo</th>
                        <th>Kms</th>
                    </tr>";
            foreach ($_SESSION['flota'] as $object=>$vehiculo) {
                echo $vehiculo->mostraEnTR();
            }
        echo "</table>
            </center>";
    }
    else {
        mensaxeErro("purple","Todavía non hay vehículos que mostrar. Rexistra un vehículo!");
    }
