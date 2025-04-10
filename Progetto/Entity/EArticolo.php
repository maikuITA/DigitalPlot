<?php

namespace Entity;

class EArticolo{

    private int $id;
    private string $titolo = "";
    private string $descrizione;
    private string $genere;
    private string $categoria;  
    private $recensioni = [];


    public function __construct(int $id, string $titolo,string $descrizione, string $genere, string $categoria) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->genere = $genere;
        $this->categoria = $categoria;
    }

    //Metodi set e get

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