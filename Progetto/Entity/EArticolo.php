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
}
?>