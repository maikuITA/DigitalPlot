<?php

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
    private ?ESconto $codSconto;

    #[ORM\ManyToOne(targetEntity: "EAbbonamento", inversedBy: "acquisti")]
    #[ORM\JoinColumn(name: "fk_abbonamento", referencedColumnName: "id_abbonamento", nullable: false)] // definizione chiave esterna
    private EAbbonamento $idAbbonamento;
     
    #[ORM\ManyToOne(targetEntity: "ECartaDiCredito", inversedBy: "acquisti")]
    #[ORM\JoinColumn(name: "fk_carta", referencedColumnName: "numeroCarta", nullable: false)] // definizione chiave esterna
    private ECartaDiCredito $numCartaDiCredito;
     
    #[ORM\Column(name: "sub_totale", type: "float")]
    private float $subTotale;


    public function __construct( string $dataAcquisto, EAbbonamento $Abbonamento, ?ESconto $Sconto, ECartaDiCredito $carta) {

        $this->idAbbonamento = $Abbonamento;
        $this->dataAcquisto = new DateTime($dataAcquisto);
        $this->codSconto = $Sconto;
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
    public function setIdAbbonamento(EAbbonamento $idAbbonamento)
    {
        $this->idAbbonamento = $idAbbonamento;
    }
    public function setCodSconto(ESconto $codSconto)
    {
        $this->codSconto = $codSconto;
    }
    
    public function setCarta(ECartaDiCredito $carta)
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
    public function getIdAbbonamento(): EAbbonamento{
        return $this->idAbbonamento;
    }
    public function getCodSconto(): ESconto{
        return $this->codSconto;
    }
    public function getCarta(): ECartaDiCredito{
        return $this->numCartaDiCredito;
    }


    public function calcolaSubTotale(EAbbonamento $Abbonamento, ESconto $Sconto): float
    {
        if ($Sconto === null){
            return $Abbonamento->getImporto();
        }
        $priceA = $Abbonamento->getImporto();
        $priceS = $Sconto->getImporto();
        $sub = $priceA - $priceS;
        return $sub;
    }
}