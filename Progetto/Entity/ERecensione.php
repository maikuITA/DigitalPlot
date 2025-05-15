<?php

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

    #[ORM\ManyToOne(targetEntity: "EAbbonato", inversedBy: "recensioni")]
    #[ORM\JoinColumn(name: "fk_abbonato", referencedColumnName: "id_utente", nullable: false)] // definizione chiave esterna
    private EAbbonato $idAbbonato;
    #[ORM\ManyToOne(targetEntity: "EArticolo", inversedBy: "recensioni")]
    #[ORM\JoinColumn(name: "fk_articolo", referencedColumnName: "id_articolo", nullable: false)] // definizione chiave esterna
    private EArticolo $idArticolo;

    public function __construct(int $valutazione, string $commento, string $dataPubblicazione, EAbbonato $idAbbonato , EArticolo $idArticolo ) {

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
    public function setIdUtente(EAbbonato $idAbbonato) {
        $this->idAbbonato = $idAbbonato;
    }
    public function getIdAbbonato(): EAbbonato {
        return $this->idAbbonato;
    }
    public function setIdArticolo(EArticolo $idArticolo) {
        $this->idArticolo = $idArticolo;
    }
    public function getIdArticolo(): EArticolo {
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