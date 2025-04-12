<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Sconti")
 */
class ESconto{
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue  
     * @ORM\Column(type="string") 
     */
    private string $codice;
    /** 
     * @ORM\Column(type="integer") 
     */
    private int $importo;


    public function __construct(string $codice, int $importo) {
        $this->codice = $codice;
        $this->importo = $importo;
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
}