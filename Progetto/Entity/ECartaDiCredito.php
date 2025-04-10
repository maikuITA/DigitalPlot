<?php

namespace Entity;

class ECartaDiCredito{
    public int $numeroCarta;
    public string $nome;
    public string $cognome;
    public string $dataScadenza;


    // Set methods
    public function setNumeroCarta($numeroCarta)
    {
        $this->numeroCarta = $numeroCarta;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    public function setDataScadenza($dataScadenza)
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