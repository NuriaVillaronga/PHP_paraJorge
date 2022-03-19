<?php include './Calculo.php'; include './Suma.php'; include './Resta.php'; include './Multiplicacion.php';?>

    <center>
		<h1>Calculadora</h1>
		<p>
			<br>
			<form method="get">
				<p>Operando1: <input type="text" name="operando1" size="30"></p>
				<p>Operando2: <input type="text" name="operando2" size="30"></p>
				<p>
					<br>
					Selecciona a operacion: 
					<select name="operacion">
						<option value="suma" selected>Suma</option>
						<option value="resta">Resta</option>
						<option value="multiplicacion">Multiplicación</option>
					</select>
				</p>
				<p>
					<br>
					<button type="submit" name="calcular">Calcular</button>
				</p>
			</form>
		</p>
	</center>

<?php

    function realizarOperacion($objOperacion, $nomeOperacion) {
        $objOperacion->calcular();
        echo $nomeOperacion . ": <b>" .$objOperacion->getResultado() ."</b><br>";  
    }

    if (isset($_GET['calcular'])) {
        if ($_GET['operacion'] == "suma") {
            echo "<center>";
                    $suma = new Suma($_GET['operando1'],$_GET['operando2']);
                    realizarOperacion($suma, "Suma");
            echo "</center>";
        }
        if ($_GET['operacion'] == "resta") {
            echo "<center>";
                    $resta = new Resta($_GET['operando1'],$_GET['operando2']);
                    realizarOperacion($resta, "Resta");
            echo "</center>";
        }
        if ($_GET['operacion'] == "multiplicacion") {
            echo "<center>";
                    $multiplicacion =new Multiplicacion($_GET['operando1'],$_GET['operando2']);
                    realizarOperacion($multiplicacion,"Multiplicacion");
            echo "</center>";
        }
    }

?>