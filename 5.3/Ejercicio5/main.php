<?php include './Cliente.php'; include './Vendedor.php'; 

    function verDatos($obj, $nome, $apelidos, $idade) {
        $obj->setNome($nome); 
        $obj->setApelidos($apelidos);
        $obj->setIdade($idade);
        echo $obj->__toString(); 
    }

    echo "<center>";
        $cliente = new Cliente();
        verDatos($cliente, "Nuria", "Villaronga Guillán", 24);
        echo "<p>";
            $vendedor = new Vendedor();
            verDatos($vendedor, "Moraima", "Villaronga Guillán", 13);
        echo "</p>";
    echo "</center>";