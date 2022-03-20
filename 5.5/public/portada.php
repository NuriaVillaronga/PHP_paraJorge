<?php

require '../vendor/autoload.php';

use Philo\Blade\Blade;

    /**
     * Instancia del gestor de plantillas informandole donde encontrar las views y la caché
     */
    $blade = new Blade('../views', '../cache');

    /**
     * Variables que se utilizarán en la view 'vistaPortada'
     */
    $titulo = 'Portada';
    $encabezado = 'Accedendo a información';

    /**
     * Creación de la view
     * En la función compact() se le pasan las librerias que se utilizarán en vistaPortada: $titulo, $encabezado
     */
    echo $blade
                ->view()
                ->make('vistaPortada', compact('titulo', 'encabezado'))
                ->render();