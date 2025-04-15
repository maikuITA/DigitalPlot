<?php
namespace Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Recensione")]
class ERecensione{

    #[ORM\Id]        
    #[ORM\GeneratedValue(strategy: "IDENTITY")]  
    #[ORM\Column(name: "id_recensione", type: "integer")] 
    private int $id;
    #[ORM\Column(type: "integer")] 
    private int $valutazione;
    #[ORM\Column(type: "string", length: 100)] 
    private string $commento;

    #[ORM\Column(name: "data_pubblicazione", type: "date")]
    private DateTime $dataPubblicazione;

    #[ORM\ManyToOne(targetEntity: "Abbonato", inversedBy: "recensioni")]
    #[ORM\JoinColumn(name: "fk_abbonato", referencedColumnName: "id_user", nullable: false)] // definizione chiave esterna
    private int $idAbbonato;
    #[ORM\ManyToOne(targetEntity: "Articolo", inversedBy: "recensioni")]
    #[ORM\JoinColumn(name: "fk_articolo", referencedColumnName: "id_articolo", nullable: false)] // definizione chiave esterna
    private int $idArticolo;

    public function __construct(int $id, int $valutazione, string $commento,string $dataPubblicazione, int $idAbbonato = 0, int $idArticolo = 0) {
        $this->id = $id;
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->idAbbonato = $$idAbbonato;
        $this->idArticolo = $idArticolo;
        $this->dataPubblicazione = new DateTime($dataPubblicazione);
    }

    //Metodi set e get
    public function setId(int $id) {
        $this->id = $id;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setValutazione(int $valutazione) {
        $this->valutazione = $valutazione;
    }
    public function getValutazione(): int {
        return $this->valutazione;
    }
    public function setCommento(string $commento) {
        $this->commento = $commento;
    }
    public function getCommento(): string {
        return $this->commento;
    }
    public function setIdUtente(int $idAbbonato) {
        $this->idAbbonato = $idAbbonato;
    }
    public function getIdAbbonato(): int {
        return $this->idAbbonato;
    }
    public function setIdArticolo(int $idArticolo) {
        $this->idArticolo = $idArticolo;
    }
    public function getIdArticolo(): int {
        return $this->idArticolo;
    }

    public function getDataPubblicazione(): DateTime {
        return $this->dataPubblicazione;
    }
    public function setDataPubblicazione(string $dataPubblicazione) {
        $this->dataPubblicazione = new DateTime($dataPubblicazione);
    }
}


?>