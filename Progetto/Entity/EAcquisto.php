<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Acquisto")
 */

class EAcquisto{

    /*
    * Ci sono delle modifiche sostanziali da fare, il motivo è spiegato nel file Doctrine.txt dalla riga 33
    * in pratica bisogna togliere gli oggetti EAbbonamento e ESconto e mettere i loro id
    * per questo bisgna modificare anche il costruttore e i metodi set e get
    */
    
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(name ="id_acquisto", type="integer") 
    */
    private int $codice;
    /** 
     * @ORM\Column(type="datetime") 
    */
    private EData $dataAcquisto;
    /** 
     * @ORM\ManyToOne(targetEntity="Abbonamento", inversedBy= "acquisti")
     * @ORM\JoinColumn(name = "fk_abbonamento", referencedColumnName = "id_abbonamento", nullable=false) // definizione chiave esterna
    */
    private int $idAbbonamento;
    /** 
     * @ORM\Column(type="object") 
    */
    private int $codSconto;
    /** 
     * @ORM\Column(name = "sub_totale", type="float") 
    */    
    private float $subTotale;


    public function __construct(int $codice, EData $dataAcquisto, int $idAbbonamento, int $codSconto = 0) {
        $this->codice = $codice;
        $this->idAbbonamento = $idAbbonamento;
        $this->dataAcquisto = $dataAcquisto;
        $this->codSconto = $codSconto;
        $this->subTotale = $this->calcolaSubTotale($this->idAbbonamento, $this->codSconto);
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
    public function setIdAbbonamento(int $idAbbonamento)
    {
        $this->idAbbonamento = $idAbbonamento;
    }
    public function setCodSconto(int $codSconto)
    {
        $this->codSconto = $codSconto;
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
    public function getIdAbbonamento(){
        return $this->idAbbonamento;
    }
    public function getCodSconto(){
        return $this->codSconto;
    }


    public function calcolaSubTotale(int $idAbbonamento, int $codSconto = 0): float
    {
        // Qui dovresti implementare la logica per calcolare il sub totale
        // in base all'id dell'abbonamento e al codice dello sconto.
        // Per ora restituiamo un valore di esempio.
        return 100.0; // esempio di sub totale
    }
}