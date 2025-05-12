<?php


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Sconto")]

class ESconto{
    
    #[ORM\Id]
    #[ORM\Column(name: "cod_sconto", type: "string", length: 100)]
    private string $codice;
    
    #[ORM\Column(type: "integer")]
    private int $importo;
    
    #[ORM\OneToMany(targetEntity: "EAcquisto", mappedBy: "codSconto", cascade: ["persist", "remove"])]
    private $acquisti = [];


    public function __construct(string $codice, int $importo, array $acquisti = []) {
        $this->codice = $codice;
        $this->importo = $importo;
        $this->acquisti = $acquisti; // inizializza l'array di acquisti
    }

    // Set methods
    public function setCodice(string $codice)
    {
        $this->codice = $codice;
    }
    public function setImporto(int $importo)
    {
        $this->importo = $importo;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getImporto(){
        return $this->importo;
    }
    // Acquisti
    public function getAcquisti(){
        return $this->acquisti;
    }
    public function addAcquisto(EAcquisto $acquisto){
        $this->acquisti[] = $acquisto;
    }
    public function removeAcquisto(EAcquisto $acquisto){
        $key = array_search($acquisto, $this->acquisti);
        if ($key !== false) {
            unset($this->acquisti[$key]);
        }
    }
    public function getAcquistiCount(){
        return count($this->acquisti);
    }
    public function getAcquistoById(int $index){
        if (array_key_exists($index, $this->acquisti)) {
            return $this->acquisti[$index];
        }
        return null;
    }

}