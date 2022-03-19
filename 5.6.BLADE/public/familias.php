<?php

require '../vendor/autoload.php';

use Clases\Familia;
use Philo\Blade\Blade;

    /**
     * Instancia del gestor de plantillas informandole donde encontrar las views y la caché
     */
    $blade = new Blade('../views', '../cache');
    
    /**
     * Llamada a la clase Familia (src) para obtener la lista de familias de la BD
     */
    $familia = new Familia(); 
    $listaFamilias = $familia->obterFamilias();

    /**
     * Variables que se utilizarán en la view 'vistaFamilias'
     */
    $titulo = 'Familias';
    $encabezado = 'Listado de Familias';

    /**
     * Creación de la view
     * En la función compact() se le pasan las librerias que se utilizarán en vistaFamilias: $titulo, $encabezado y $listaFamilias
     */
    echo $blade
                ->view()
                ->make('vistaFamilias', compact('titulo', 'encabezado', 'listaFamilias'))
                ->render();