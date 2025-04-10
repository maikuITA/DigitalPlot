<?php

namespace Entity;  

class EScrittore extends EAbbonato{
    private int $numFollowers = 0;
    private int $numFollowing = 0;
    private int $numeroArticoli;
    private $articoli = [];
    private float $valutazione;

    public function __construct(int $id, string $username, string $password, string $email, string $nome, string $cognome, string $dataNascita) {
        parent::__construct($id, $username, $password, $email, $nome, $cognome, $dataNascita);
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
}



