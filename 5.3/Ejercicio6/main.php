<?php include './ArtigoC.php';

    $artigo1 = new ArtigoC(1,"Artigo","12.5");
    $artigo2 = clone $artigo1;
    $artigo3 = new ArtigoC(4,"Artigo3","189.4");

    $artigo1->comparar($artigo2);
    $artigo2->comparar($artigo3);
    $artigo1->comparar("fejrcejhrnc");

    