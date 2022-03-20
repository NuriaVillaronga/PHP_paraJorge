<?php

require '../vendor/autoload.php';

use Clases\Producto;
use Philo\Blade\Blade;

    /**
     * Instancia del gestor de plantillas informandole donde encontrar las views y la caché
     */
    $blade = new Blade('../views', '../cache');
    
    /**
     * Llamada a la clase Producto (src) para obtener la lista de productos de la BD
     */
    $producto = new Producto();
    $listaProductos = $producto->obterProductos();

    /**
     * Variables que se utilizarán en la view 'vistaProductos'
     */
    $titulo = 'Productos';
    $encabezado = 'Listado de Productos';

    /**
     * Creación de la view
     * En la función compact() se le pasan las librerias que se utilizarán en vistaProductos: $titulo, $encabezado y $listaProductos
     */
    echo $blade
                ->view()
                ->make('vistaProductos', compact('titulo', 'encabezado', 'listaProductos'))
                ->render();
