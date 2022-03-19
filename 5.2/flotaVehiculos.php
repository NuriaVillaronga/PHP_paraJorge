<?php 
include 'Vehiculo.php'; 
session_start();
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
        <p><br>
            <form method='get'>
                <button formaction='flotaVehiculos.php' name='gardarFicheiro'>Gardar datos en ficheiro</button>
                <p><button formaction='flotaVehiculos.php' name='recuperarFicheiro'>Recuperar datos de ficheiro</button></p>
                <p><button formaction='./pecharSesion.php' name='peche'>Pechar sesión</button></p>
            </form>
        </p>
	</center>

<?php

    function mensaxe($cor, $mensaxe) {
        echo "<center>
                <p><br>
                    <h3 style='color:".$cor.";'>".$mensaxe."<h3>
                </p>
            </center>";
    }

    function listaxeVehiculos() {
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

    function gardarDatosFicheiro() {
        if(!($ficheiro=fopen('flota.txt','w'))) {
            return;
        }
        else {
            foreach ($_SESSION['flota'] as $object=>$vehiculo) {
                fprintf($ficheiro,"%s-%s-%s\n",$vehiculo->getMatricula(),$vehiculo->getModelo(),$vehiculo->getKms());
            }
        }
    }

    /**
     * Engadir vehiculo
     */
    if (isset($_GET['engadir'])) {
        if (is_numeric($_GET['kms']) == true) {
            
            //Evitar repeticion de vehiculos con = caracteristicas
            
            if (isset($_SESSION['flota'])) {
                foreach ($_SESSION['flota'] as $object=>$vehiculo) {
                    if ($vehiculo->getMatricula() == $_GET['matricula'] && $vehiculo->getModelo() == $_GET['modelo'] && $vehiculo->getKms() == $_GET['kms']) {
                        mensaxe("red","Xa existe un vehículo con estas caracteristicas");
                        die();
                    }
                }
            }
            
            $_SESSION['flota'][] = new Vehiculo($_GET['matricula'],$_GET['modelo'],$_GET['kms']);
        }
        else {
            mensaxe("red","Nos kms debes introducir un número válido");
        }
    }

    /**
     * Listar vehiculos
     */
    if (isset($_SESSION['flota'])) {
        listaxeVehiculos();
    }
    else {
        mensaxe("purple","Todavía non hay vehículos que mostrar. Rexistra un vehículo!");
    }

    /**
     * Gardar vehiculos en ficheiro
     */
    if (isset($_GET['gardarFicheiro'])) {
        if (empty($_SESSION['flota']) == false) {
            gardarDatosFicheiro();
            mensaxe("green","Ficheiro creado!");
        }
        else {
            mensaxe("red","Non hai datos para gardar no ficheiro"); 
        }
    }

    /**
     * Recuperar vehiculos do ficheiro
     */
    if (isset($_GET['recuperarFicheiro'])) {
        $flotaArray = file("flota.txt"); 
        $flota=[];
        for($i=0;$i<count($flotaArray);$i++)
        {
            $campo = explode("-", $flotaArray[$i]);
            $flota[$campo[0]]= $campo[1];
        }
    }
