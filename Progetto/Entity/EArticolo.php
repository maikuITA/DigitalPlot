<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Articolo")
 */
class EArticolo{

    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(name = "id_articolo", type="integer") 
     */
    private int $id;
    /** 
     * @ORM\Column(type="string") 
     */
    private string $titolo = "";
    /** 
     * @ORM\Column(type="string") 
     */
    private string $descrizione;
    /** 
     * @ORM\Column(type="string") 
     */
    private string $genere;
    /** 
     * @ORM\Column(type="string") 
     */
    private string $categoria;
    /** 
     * @ORM\OneToMany(targetEntity="Articolo", mappedBy="id_recensione", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */ 
    private $recensioni = [];
    /** 
     * @ORM\ManyToOne(targetEntity="Scrittore", inversedBy= "articoli")
     * @ORM\JoinColumn(name = "fk_scrittore", referencedColumnName = "id_user", nullable=false) // definizione chiave esterna
    */
    private $idScrittore;


    public function __construct(int $id, string $titolo,string $descrizione, string $genere, string $categoria) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->genere = $genere;
        $this->categoria = $categoria;
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
}
?>