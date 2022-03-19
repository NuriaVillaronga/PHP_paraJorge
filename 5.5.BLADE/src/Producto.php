<?php

namespace Clases;

use PDO;
use PDOException;

class Producto extends Conexion
{
    private $id;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $familia;
    private $descripcion;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Devuelve unha lista con todos os productos
     *
     * @return PDOStatement
     */
    function obterProductos() 
    {
        try {
            $existeListaProdutos = $this->conexion->query("SELECT * FROM productos ORDER BY nombre");

            if ($existeListaProdutos->rowCount() != 0)  {
                $listaProdutos = $existeListaProdutos->fetchAll(PDO::FETCH_OBJ);
            }
            else {
                die("<center><p style='color:red;'><br><b>A listaxe de produtos está baleira</b></p></center>");
            }
        }catch (PDOException $error) {
            die("Erro na consulta executada: " . $error->getMessage());
        }
        finally {
            $this->conexion = null;
        }

        return $listaProdutos;
    }


    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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

    /**
     * Get the value of nombre_corto
     */ 
    public function getNombre_corto()
    {
        return $this->nombre_corto;
    }

    /**
     * Set the value of nombre_corto
     *
     * @return  self
     */ 
    public function setNombre_corto($nombre_corto)
    {
        $this->nombre_corto = $nombre_corto;

        return $this;
    }

    /**
     * Get the value of pvp
     */ 
    public function getPvp()
    {
        return $this->pvp;
    }

    /**
     * Set the value of pvp
     *
     * @return  self
     */ 
    public function setPvp($pvp)
    {
        $this->pvp = $pvp;

        return $this;
    }

    /**
     * Get the value of familia
     */ 
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set the value of familia
     *
     * @return  self
     */ 
    public function setFamilia($familia)
    {
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}

