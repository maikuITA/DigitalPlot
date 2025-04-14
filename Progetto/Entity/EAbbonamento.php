<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Abbonamento")
 */
class EAbbonamento{  // codice tipo periodo importo

    // definisco il campo come chiave primaria con la prima @ORM\Id, mentre la seconda permette di far generare il valore del campo dal sistema (si può specificare la strategia di generazione)
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue  
     * @ORM\Column(name="id_abbonamento",type="string") 
     */

    public int $codice;
    /** 
     * @ORM\Column(type="string", length=100) 
     */
    private string $tipo; 
    /** 
     * @ORM\Column(type="string", length=100) 
     */
    private string $periodo;
    /** 
     * @ORM\Column(type="float") 
     */ 
    private float $importo;
    /** 
     * @ORM\OneToMany(targetEntity="Acquisto", mappedBy="abbonamento", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */
    private $acquisti = []; // array di acquisti associati all'abbonamento
    
    
    public function __construct(int $codice, string $tipo,string $periodo, string $importo) {
        $this->codice = $codice;
        $this->tipo = $tipo;
        $this->periodo = $periodo;
        $this->importo = $importo;
        $this->acquisti = []; // inizializza l'array di acquisti
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

