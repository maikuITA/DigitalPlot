<?php

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table("Acquisto")]
class EAcquisto{
    
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id_acquisto", type: "integer")]
    private int $codice;
    
    #[ORM\Column(name: "data_acquisto", type: "date")]
    private DateTime $dataAcquisto;
    
    
    #[ORM\ManyToOne(targetEntity: "ESconto", inversedBy: "acquisti")]
    #[ORM\JoinColumn(name: "fk_sconto", referencedColumnName: "cod_sconto", nullable: true)] // definizione chiave esterna
    private int $codSconto;

    #[ORM\ManyToOne(targetEntity: "EAbbonamento", inversedBy: "acquisti")]
    #[ORM\JoinColumn(name: "fk_abbonamento", referencedColumnName: "id_abbonamento", nullable: false)] // definizione chiave esterna
    private int $idAbbonamento;
     
    #[ORM\ManyToOne(targetEntity: "ECartaDiCredito", inversedBy: "acquisti")]
    #[ORM\JoinColumn(name: "fk_carta", referencedColumnName: "numeroCarta", nullable: false)] // definizione chiave esterna
    private int $numCartaDiCredito;
     
    #[ORM\Column(name: "sub_totale", type: "float")]
    private float $subTotale;


    public function __construct( string $dataAcquisto, int $idAbbonamento, int $codSconto = 0, int $carta = 0) {

        $this->idAbbonamento = $idAbbonamento;
        $this->dataAcquisto = new DateTime($dataAcquisto);
        $this->codSconto = $codSconto;
        $this->numCartaDiCredito = $carta;
        $this->subTotale = $this->calcolaSubTotale($this->idAbbonamento, $this->codSconto);
    }
    
    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    public function setDataAcquisto(string $dataAcquisto)
    {
        $this->dataAcquisto = new DateTime($dataAcquisto);
    }
    public function setIdAbbonamento(int $idAbbonamento)
    {
        $this->idAbbonamento = $idAbbonamento;
    }
    public function setCodSconto(int $codSconto)
    {
        $this->codSconto = $codSconto;
    }
    
    public function setCarta(int $carta)
    {
        $this->numCartaDiCredito = $carta;
    }
    
    // Get methods
    public function getCodice(): int{
        return $this->codice;
    }
    public function getDataAcquisto(): DateTime{
        return $this->dataAcquisto;
    }
    public function getSubTotale(): float{
        $this->subTotale = $this->calcolaSubTotale($this->idAbbonamento, $this->codSconto);
        return $this->subTotale;
    }
    public function getIdAbbonamento(): int{
        return $this->idAbbonamento;
    }
    public function getCodSconto(): string{
        return $this->codSconto;
    }
    public function getCarta(): int{
        return $this->numCartaDiCredito;
    }


    public function calcolaSubTotale(int $idAbbonamento, int $codSconto = 0): float
    {
        // Qui dovresti implementare la logica per calcolare il sub totale
        // in base all'id dell'abbonamento e al codice dello sconto.
        // Per ora restituiamo un valore di esempio.
        return 100.0; // esempio di sub totale
    }
}