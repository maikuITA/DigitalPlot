<?php
namespace Entity;  
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Letture")
 */
class ELettura{
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(type="integer") 
     */
    private int $codice;

    public function __construct(int $codice) {
        $this->codice = $codice;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
}