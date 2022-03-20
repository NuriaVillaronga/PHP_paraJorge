<?php

namespace Clases;

use PDO;
use PDOException;

class Familia extends Conexion
{
    private $cod;
    private $nombre;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Devuelve unha lista con todas as familiass
     *
     * @return PDOStatement
     */
    function obterFamilias() 
    {
        try {
            $existeListaFamilias = $this->conexion->query("SELECT * FROM familias ORDER BY nombre"); 

            if ($existeListaFamilias->rowCount() != 0)  {
                $listaFamilias = $existeListaFamilias->fetchAll(PDO::FETCH_OBJ);
            }
            else {
                die("<center><p style='color:red;'><br><b>A listaxe de familias está baleira</b></p></center>");
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $this->conexion = null; 
        }

        return $listaFamilias;
    }

    /**
     * Get the value of cod
     */ 
    public function getCod()
    {
        return $this->cod;
    }

    /**
     * Set the value of cod
     *
     * @return  self
     */ 
    public function setCod($cod)
    {
        $this->cod = $cod;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
