<?php
namespace Entity;  

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "Scrittore")]
class EScrittore extends EAbbonato{
    
    
    #[ORM\Column(type: "integer")]
    private int $numFollowers = 0;
    
    #[ORM\Column(type: "integer")]
    private int $numFollowing = 0;
   
    #[ORM\Column(type: "integer")]
    private int $numeroArticoli;
    
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EArticolo", mappedBy: "idScrittore", cascade: ["persist", "remove"])]
    private $articoli = [];
    
    #[ORM\Column(type: "float")]
    private float $valutazione;

    public function __construct(string $username, string $password, string $nome, string $cognome, string $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "", $followers = [], $following = [], $articoli = []) {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia, $followers, $following);
        $this->numFollowers = count($followers);
        $this->numFollowing = count($following);
        $this->numeroArticoli = count($articoli);
        $this->articoli = $articoli;
        $this->valutazione = $this->aggiornaValutazione($articoli);
    }

    public function addArticolo(EArticolo $articolo): void{
        array_push($this->articoli, $articolo);
    }
    public function getArticoli(): array{
        return $this->articoli;
    }
    public function getArticolo(int $index): EArticolo{
        return $this->articoli[$index];
    }
    public function getNumArticoli(): int{
        $numeroArticoli = count($this->articoli);
        return $numeroArticoli;
    }
    public function aggiornaFollowers(): void{
        $this->numFollowers = parent::getNumFollowers();
    }
    public function aggiornaFollowing(): void{
        $this->numFollowing = parent::getNumFollowing();
    }
    public function aggiornaValutazione(array $articoli): float{
        $media = 0;
        foreach($articoli as $articolo){
            $media = $media + $articolo->getMediaValutazione();
        }
        $valutazione = $media / count($articoli);
        return $valutazione;
    }
    public function getValutazione(): float{
        return $this->valutazione;
    }
    public function setValutazione(float $valutazione): void{
        $this->valutazione = $valutazione;
    }
    public function getNumFollowers(): int{
        return $this->numFollowers;
    }
    public function setNumFollowers(int $numFollowers): void{
        $this->numFollowers = $numFollowers;
    }
    public function getNumFollowing(): int{
        return $this->numFollowing;
    }
    public function setNumFollowing(int $numFollowing): void{
        $this->numFollowing = $numFollowing;
    }
    public function getNumeroArticoli(): int{
        return $this->numeroArticoli;
    }
}



