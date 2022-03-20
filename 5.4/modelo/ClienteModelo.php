<?php
include_once('Conexion.php');
include_once('Cliente.php');

class ClienteModelo extends Cliente{

    public function __construct($nome, $apelidos, $email) 
    {
        parent::__construct($nome,$apelidos,$email);
    }

    /**
     * Engade un cliente á base de datos. Devolve un mensaxe en función de si o cliente puido añadirse ou non.
     *
     * @param string $nomeRexistro
     * @param string $apelidosRexistro
     * @param string $emailRexistro   
     * @return string
     */
    public static function engadirCliente($nomeRexistro, $apelidosRexistro, $emailRexistro) : string
    {
        $conexionPDO = new Conexion(); 

        try {
            $obterClientes = $conexionPDO->query("SELECT * FROM clientes WHERE email='{$emailRexistro}'");

            if ($obterClientes->rowCount() == 0)  {
                $engadirCliente = $conexionPDO->prepare("INSERT INTO clientes (nome, apelidos, email) VALUES ('{$nomeRexistro}', '{$apelidosRexistro}', '{$emailRexistro}')");
                $engadirCliente->execute();
                $mensaxe = "<b style='color:green;'>O cliente rexistrouse correctamente</b>";
            }
            else {
                $mensaxe = "<b style='color:red;'>O cliente que intentaches rexistrar xa existe</b>";
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $mensaxe;
    }

    /**
     * Elimina o cliente da taboa no que se premeuo botón de "Eliminar"
     *
     * @param string $emailClienteEliminar
     * @return string
     */
    public static function eliminarCliente($emailClienteEliminar) : string
    {
        $conexionPDO = new Conexion(); 

        try {

            $clienteEliminar = $conexionPDO->prepare("DELETE FROM clientes WHERE email='{$emailClienteEliminar}'");
            $clienteEliminar->execute();
            $mensaxe = "<b style='color:green;'>O cliente foi eliminado correctamente</b>";

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        } 
        finally {
            $conexionPDO = null; 
        }

        return $mensaxe;
    }

    /**
     * Devolve o cliente que se corresponde co email introducido, ou un mensaxe de erro si o email introducio non existe
     *
     * @param string $emailBuscar
     * @return PDOStatement
     */
    public static function buscarClienteEmail($emailBuscar) : PDOStatement 
    {
        $conexionPDO = new Conexion(); 

        try {
            $existeCliente = $conexionPDO->query("SELECT * FROM clientes WHERE email='{$emailBuscar}'");

            if ($existeCliente->rowCount() == 1)  {
                $clienteEncontrado = $existeCliente;
            }
            else {
                die("<center><p style='color:red;'><br><b>O email que introduciches non coincide có de ningún cliente</b></p></center>");
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $clienteEncontrado;
    }

    /**
     * Elimina o cliente que se corresponde co email introducido. Devolve un mensaxe en función de si se puido eliminar ou non o cliente.
     *
     * @param string $emailEliminar
     * @return string
     */
    public static function eliminarClienteEmail($emailEliminar) : string
    {
        $conexionPDO = new Conexion(); 

        try {
            $existeCliente = $conexionPDO->query("SELECT * FROM clientes WHERE email='{$emailEliminar}'");

            if ($existeCliente->rowCount() == 1)  {
                $eliminarClienteEmail = $conexionPDO->prepare("DELETE FROM clientes WHERE email='{$emailEliminar}'");
                $eliminarClienteEmail->execute();
                $mensaxe = "<b style='color:green;'>O cliente foi eliminado correctamente</b>";
            }
            else {
                $mensaxe = "<b style='color:red;'>O email que introduciches non existe</b>";
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }

        return $mensaxe;
    }

    /**
     * Modifica o cliente (nome e apelidos), segun o email introducido. Devolve un mensaxe en función de si o cliente actualizaouse correctamente ou non
     *
     * @param string $nome
     * @param string $apelidos 
     * @return string
     */
    public static function actualizarCliente($nome, $apelidos) : string
    {
        $conexionPDO = new Conexion(); 

        try {

            $clienteActualizar = $conexionPDO->prepare("UPDATE clientes SET nome = '{$nome}', apelidos = '{$apelidos}'");
            $clienteActualizar->execute();
            $mensaxe = "<b style='color:green;'>O cliente foi modificado correctamente</b>";

        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        } 
        finally {
            $conexionPDO = null; 
        }

        return $mensaxe;
    }

    /**
     * Devolve todos os clientes da base de datos
     *
     * @return PDOStatement
     */
    public static function obterClientes() : PDOStatement 
    {
        $conexionPDO = new Conexion(); 

        try {
            $obterClientes = $conexionPDO->query("SELECT * FROM clientes");
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $conexionPDO = null;
        }
        
        return $obterClientes;
    }
}