<?php

    //Introduzco en el campo de comentario lo siguiente : <script>alert("Hola")</script>
    //Si no utilizas htmlentities() se ejecutará el codigo JS, si utilizas htmlentities, el codigo JS se mostará como texto.

    if(isset($_GET['insertar'])) {
        echo $_GET['comentario']; 
        echo "<h3>Comentario</h3>". htmlentities($_GET['comentario']); 
    }

?>