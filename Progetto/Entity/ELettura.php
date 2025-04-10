<?php

namespace Entity;  

class ELettura{
    private int $codice;

    public function __construct(int $codice) {
        $this->codice = $codice;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
}