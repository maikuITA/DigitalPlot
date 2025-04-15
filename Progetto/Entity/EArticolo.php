<?php
namespace Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;




#[ORM\Entity]
#[ORM\Table(name: "Articolo")]
class EArticolo{

    #[ORM\Id]   
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id_articolo", type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "string", length: 100)]
    private string $titolo = "";
    
    #[ORM\Column(type: "text")]
    private string $descrizione;
    
    #[ORM\Column(name: "genere", type: "string", length: 100)]
    private string $genere;
    
    #[ORM\Column(name: "categoria", type: "string", length: 100)]
    private string $categoria;
    
    #[ORM\Column(name:"data_pubblicazione",type: "date")]
    private DateTime $dataPubblicazione;
    
    #[ORM\OneToMany(targetEntity: "ERecensione", mappedBy: "idArticolo", cascade: ["persist", "remove"])]
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private $recensioni = [];
    
    #[ORM\ManyToOne(targetEntity: "EScrittore", inversedBy: "articoli")]
    #[ORM\JoinColumn(name: "fk_scrittore", referencedColumnName: "id_utente", nullable: false)] // definizione chiave esterna
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private int $idScrittore;
    /** 
     * @ORM\OneToMany(targetEntity="Lettura", mappedBy="idArticolo", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */
    #[ORM\OneToMany(targetEntity: "ELettura", mappedBy: "articoli", cascade: ["persist", "remove"])]
    private $letture = [];


    public function __construct(int $id, string $titolo,string $descrizione, string $genere, string $categoria, string $dataPubblicazione, int $idScrittore, array $letture = [], array $recensioni = []) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->genere = $genere;
        $this->categoria = $categoria;
        $this->dataPubblicazione = new DateTime($dataPubblicazione);
        $this->letture = $letture;
        $this->idScrittore = $idScrittore;
        $this->recensioni = $recensioni;
    }

    //Metodi set e get
    
    public function getMediaValutazione(): float {
        $somma = 0;
        $count = 0;
        foreach ($this->recensioni as $recensione) {
            $somma += $recensione->getValutazione();
            $count++;
        }
        return $count > 0 ? $somma / $count : 0;
    }


    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setTitolo(string $titolo) {
        $this->titolo = $titolo;
    }

    public function getTitolo(): string {
        return $this->titolo;
    }

    public function setDescrizione(string $descrizione) {
        $this->descrizione = $descrizione;
    }

    public function getDescrizione(): string {
        return $this->descrizione;
    }

    public function setGenere(string $genere) {
        $this->genere = $genere;
    }

    public function getGenere(): string {
        return $this->genere;
    }

    public function setCategoria(string $categoria) {
        $this->categoria = $categoria;
    }

    public function getCategoria(): string {
        return $this->categoria;
    }
    public function setIdScrittore(int $idScrittore) {
        $this->idScrittore = $idScrittore;
    }
    public function getIdScrittore(): int {
        return $this->idScrittore;
    }
    public function setDataPubblicazione(string $dataPubblicazione){
        $this->dataPubblicazione = new DateTime($dataPubblicazione);
    }
    public function getDataPubblicazione(): DateTime{
        return $this->dataPubblicazione;
    }

    //Gestione delle recensioni

    public function addRecensione(ERecensione $recensione): void {
        array_push($this->recensioni, $recensione);
    }
    public function getRecensioni(): array {
        return $this->recensioni;
    }
    public function getRecensioneById(int $id): ?ERecensione {
        foreach ($this->recensioni as $recensione) {
            if ($recensione->getId() === $id) {
                return $recensione;
            }
        }
        return null;
    }
    public function removeRecensione(int $id): void {
        foreach ($this->recensioni as $key => $recensione) {
            if ($recensione->getId() === $id) {
                unset($this->recensioni[$key]);
                break;
            }
        }
    }
    public function getRecensioneCount(): int {
        return count($this->recensioni);
    }
    //Gestione delle letture
    public function addLettura(ELettura $lettura): void {
        array_push($this->letture, $lettura);
    }
    public function getLetture(): array {
        return $this->letture;
    }
    public function getLetturaById(int $id): ?ELettura {
        foreach ($this->letture as $lettura) {
            if ($lettura->getId() === $id) {
                return $lettura;
            }
        }
        return null;
    }
    public function removeLettura(int $id): void {
        foreach ($this->letture as $key => $lettura) {
            if ($lettura->getId() === $id) {
                unset($this->letture[$key]);
                break;
            }
        }
    }
    public function getLetturaCount(): int {
        return count($this->letture);
    }
}
?>