<?php include './Comparar.php';

class ArtigoC implements Comparar{

    private int $id;
    private string $nome;
    private float $prezo;

    public function __construct($id, $nome, $prezo)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->prezo = $prezo;
    }

    public function __clone()
    {
        $this->nome = $this->nome; 
        $this->id = ($this->id)+1;
        $this->prezo = $this->prezo;
    }

    public function comparar($artigo) {
        if ($artigo instanceof ArtigoC) {
            if ($this->getPrezo() == $artigo->getPrezo()) {
                echo "<h4 style='color:green;'>Ambos artigos teñen o mesmo prezo</h4>";
            }
            else {
                echo "<h4 style='color:red'>Os artigos teñen diferente prezo</h4>"; 
            }
        }
        else {
            throw new Exception("O artigo introducido non é de tipo ArtigoC");
        }
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

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
     * Get the value of prezo
     */ 
    public function getPrezo()
    {
        return $this->prezo;
    }

    /**
     * Set the value of prezo
     *
     * @return  self
     */ 
    public function setPrezo($prezo)
    {
        $this->prezo = $prezo;

        return $this;
    }
}