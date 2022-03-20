<?php

require_once('../modelo/ClienteModelo.php');
require_once('../vista/vistaCliente.php');

    //Chamamos aos botóns da vista

    if(isset($_GET['mostrarClientes'])) {
        $clientes = ClienteModelo::obterClientes(); //Se solicitan todos los clientes al modelo (ClienteModelo)
        
        while($fila = $clientes->fetch(PDO::FETCH_ASSOC)) {
            $arrayClientes[]= $fila; 
        }
        echo "<center><p><br>";
            mostrarClientes($arrayClientes); //Chamada a funcion mostrarClientes da vista (vistaCliente)
        echo "</p></center>";
    }

    if(isset($_GET['engadirCliente'])) {
        echo "<center><p><br>";
            formularioRexistro(); //Chamada a vista
        echo "</p></center>";
    }

    if (isset($_GET['enviarRexistro'])) {
        if ($_GET['nomeCliente'] != null and $_GET['apelidosCliente'] != null and $_GET['emailCliente'] != null) {
            $mensaxe = ClienteModelo::engadirCliente($_GET['nomeCliente'], $_GET['apelidosCliente'], $_GET['emailCliente']);

            echo "<center><p><br>";
                mostrarMensaxe($mensaxe); //Chamada a vista
            echo "</p></center>";
        }
        else {
            echo "<center><p style='color:red;'><br><b>Os campos para introducir un novo usuario non poden estar baleiros</b></p></center>";
        }
    }

    if(isset($_GET['borrarCliente'])) {
        $clientes = ClienteModelo::obterClientes(); 
        
        while($fila = $clientes->fetch(PDO::FETCH_ASSOC)) {
            $arrayClientes[]= $fila; 
        }
        echo "<center><p><br>";
            mostrarClientesEliminar($arrayClientes); //Chamada a vista
        echo "</p></center>";
    }

    if(isset($_GET['enviarEliminado'])) {
        $mensaxe = ClienteModelo::eliminarCliente($_GET['enviarEliminado']); 
        
        echo "<center><p><br>";
                mostrarMensaxe($mensaxe); //Chamada a vista
        echo "</p></center>";
    }

    if(isset($_GET['buscarEmail'])) {
        echo "<center><p><br>";
            formularioEmailBuscar(); //Chamada a vista
        echo "</p></center>";
    }

    if(isset($_GET['enviarEmailBuscar'])) {
        if($_GET['emailBuscar'] != null) {
            $clientes = ClienteModelo::buscarClienteEmail($_GET['emailBuscar']); 
        
            echo "<center><p><br>";
                mostrarClientes($clientes); //Chamada a vista
            echo "</p></center>";
        }
    }

    if(isset($_GET['borrarEmail'])) {
        echo "<center><p><br>";
            formularioEmailBorrar(); //Chamada a vista
        echo "</p></center>";
    }

    if(isset($_GET['enviarEmailEliminar'])) {
        if($_GET['emailEliminar'] != null) {
            $mensaxe = ClienteModelo::eliminarClienteEmail($_GET['emailEliminar']); 
        
            echo "<center><p><br>";
                    mostrarMensaxe($mensaxe); //Chamada a vista
            echo "</p></center>";
        }
    }

    if(isset($_GET['actualizarEmail'])) {
        echo "<center><p><br>";
            formularioEmailActualizar(); //Chamada a vista
        echo "</p></center>";
    }

    if(isset($_GET['enviarEmailActualizado'])) {
        if($_GET['emailActualizar'] != null) {
            $clientes = ClienteModelo::buscarClienteEmail($_GET['emailActualizar']); 
        
            echo "<center><p><br>";
                formularioActualizacion($clientes); //Chamada a vista
            echo "</p></center>";
        }
    }

    if(isset($_GET['actualizar'])) {
        if($_GET['nomeActualizado'] != null and $_GET['apelidosActualizados'] != null) {
            $mensaxe = ClienteModelo::actualizarCliente($_GET['nomeActualizado'], $_GET['apelidosActualizados']); 
        
            echo "<center><p><br>";
                    mostrarMensaxe($mensaxe); //Chamada a vista
            echo "</p></center>";
        }
    }