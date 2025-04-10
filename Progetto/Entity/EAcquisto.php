<?php

namespace Entity;

class EAcquisto{
    private int $codice;
    private EData $dataAcquisto;
    private float $subTotale;


    public function __construct(int $codice, EData $dataAcquisto, float $subTotale) {
        $this->codice = $codice;
        $this->dataAcquisto = $dataAcquisto;
        $this->subTotale = $subTotale;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    public function setDataAcquisto(EData $dataAcquisto)
    {
        $this->dataAcquisto = $dataAcquisto;
    }
    public function setSubTotale($subTotale)
    {
        $this->subTotale = $subTotale;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getDataAcquisto(){
        return $this->dataAcquisto;
    }
    public function getSubTotale(){
        return $this->subTotale;
    }

}