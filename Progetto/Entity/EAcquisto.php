<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Abbonati")
 */

class EAcquisto{
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(type="integer") 
    */
    private int $codice;

    // con object il campo è di tipo blob
    /** 
     * @ORM\Column(type="datetime") 
    */
    private EData $dataAcquisto;
    /** 
     * @ORM\Column(type="")
    */
    private EAbbonamento $abbonamento;
    /** 
     * @ORM\Column(type="object") 
    */
    private ESconto $sconto;
    /** 
     * @ORM\Column(type="float") 
    */    
    private float $subTotale;


    public function __construct(int $codice, EData $dataAcquisto, EAbbonamento $abbonamento, ESconto $sconto = null) {
        $this->codice = $codice;
        if ($sconto == null) {
            $sconto = new ESconto("Nessuno", 0);
        }
        $this->dataAcquisto = $dataAcquisto;
        $this->abbonamento = $abbonamento;
        $this->sconto = $sconto;
        $this->subTotale = $abbonamento->getImporto() - $sconto->getImporto();
    }
    
    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    public function setDataAcquisto(EData $dataAcquisto)
    {
        $this->dataAcquisto = $dataAcquisto;
    }
    public function setAbbonamento(EAbbonamento $abbonamento)
    {
        $this->abbonamento = $abbonamento;
    }
    public function setSconto(ESconto $sconto)
    {
        $this->sconto = $sconto;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getDataAcquisto(){
        return $this->dataAcquisto;
    }
    public function getSubTotale(){
        return $this->subTotale;
    }
    public function getAbbonamento(){
        return $this->abbonamento;
    }
    public function getSconto(){
        return $this->sconto;
    }

}