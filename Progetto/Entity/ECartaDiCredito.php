<?php

namespace Entity;

class ECartaDiCredito{
    public int $numeroCarta;
    public string $nome;
    public string $cognome;
    public EData $dataScadenza;

    public function __construct(int $numeroCarta, string $nome,string $cognome, EData $dataScadenza) {
        $this->numeroCarta = $numeroCarta;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->dataScadenza = $dataScadenza;
    }

    // Set methods
    public function setNumeroCarta(int $numeroCarta)
    {
        $this->numeroCarta = $numeroCarta;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setCognome(string $cognome)
    {
        $this->cognome = $cognome;
    }

    public function setDataScadenza(EData $dataScadenza)
    {
        $this->dataScadenza = $dataScadenza;
    }

    // Get methods
    public function getNumeroCarta(){
        return $this->numeroCarta;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCognome(){
        return $this->cognome;
    }

    public function getDataScadenza(){
        return $this->dataScadenza;
    }

}