<?php
namespace Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="CarteDiCredito")
 */
class ECartaDiCredito{
    /** 
     * @ORM\id             
     * @ORM\Column(type="integer") 
     */
    public int $numeroCarta;
    /**         
     * @ORM\Column(type="string", length=100) 
    */
    public string $nome;
    /**         
     * @ORM\Column(type="string", length=100) 
    */
    public string $cognome;
    /**         
     * @ORM\Column(type="date") 
    */
    public DateTime $dataScadenza;
    /** 
     * @ORM\OneToMany(targetEntity="Acquisto", mappedBy="numCartaDiCredito", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */
    private $acquisti = [];

    public function __construct(int $numeroCarta, string $nome,string $cognome, string $dataScadenza, array $acquisti = []) {
        $this->numeroCarta = $numeroCarta;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->dataScadenza = new DateTime($dataScadenza);
        $this->acquisti = $acquisti; // inizializza l'array di acquisti
    }

    // Set methods
    public function setNumeroCarta(int $numeroCarta)
    {
        $this->numeroCarta = $numeroCarta;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setCognome(string $cognome)
    {
        $this->cognome = $cognome;
    }

    public function setDataScadenza(string $dataScadenza)
    {
        $this->dataScadenza = new DateTime($dataScadenza);
    }

    // Get methods
    public function getNumeroCarta(): int{
        return $this->numeroCarta;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getCognome(): string{
        return $this->cognome;
    }

    public function getDataScadenza(): DateTime{
        return $this->dataScadenza;
    }
     //Acquisti
     public function getAcquisti(): array{
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