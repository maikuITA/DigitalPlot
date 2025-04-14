<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Abbonamenti")
 */
class EAbbonamento{  // codice tipo periodo importo

    // definisco il campo come chiave primaria con la prima @ORM\Id, mentre la seconda permette di far generare il valore del campo dal sistema (si può specificare la strategia di generazione)
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer") 
     */
    public int $codice;
    /** 
     * @ORM\Column(type="string", length=100) 
     */
    public string $tipo; 
    /** 
     * @ORM\Column(type="string", length=100) 
     */
    public string $periodo;
    /** 
     * @ORM\Column(type="float") 
     */ 
    public float $importo;
    
    public function __construct(int $codice, string $tipo,string $periodo, string $importo) {
        $this->codice = $codice;
        $this->tipo = $tipo;
        $this->periodo = $periodo;
        $this->importo = $importo;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }
    public function setPeriodo(string $periodo)
    {
        $this->periodo = $periodo;
    }
    public function setImporto($importo)
    {
        $this->importo = $importo;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getPeriodo(){
        return $this->periodo;
    }
    public function getImporto(){
        return $this->importo;
    }
}

