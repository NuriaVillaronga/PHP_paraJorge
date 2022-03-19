<?php include './Artigo.php';

$artigo1 = new Artigo(1,"Artigo1");

$artigo2 = clone $artigo1;

echo $artigo2;