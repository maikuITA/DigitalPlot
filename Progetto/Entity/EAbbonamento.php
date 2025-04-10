<?php

namespace Entity;

class EAbbonamento{  // codice tipo periodo importo
    public string $codice;
    public string $tipo; 
    public string $periodo; 
    public float $importo;
    
    public function __construct(int $codice, string $tipo,string $periodo, string $importo) {
        $this->codice = $codice;
        $this->tipo = $tipo;
        $this->periodo = $periodo;
        $this->importo = $importo;
    }

    // Set methods
    public function setCodice(string $codice)
    {
        $this->codice = $codice;
    }
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }
    public function setPeriodo(string $periodo)
    {
        $this->periodo = $periodo;
    }
    public function setImporto($importo)
    {
        $this->importo = $importo;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getPeriodo(){
        return $this->periodo;
    }
    public function getImporto(){
        return $this->importo;
    }
}

