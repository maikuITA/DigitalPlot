<?php

namespace Entity;

class ERecensione{

    private int $id;
    private int $valutazione;
    private string $commento;

    public function __construct(int $id, int $valutazione, string $commento) {
        $this->id = $id;
        $this->valutazione = $valutazione;
        $this->commento = $commento;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setValutazione(int $valutazione) {
        $this->valutazione = $valutazione;
    }
    public function getValutazione(): int {
        return $this->valutazione;
    }
    public function setCommento(string $commento) {
        $this->commento = $commento;
    }
    public function getCommento(): string {
        return $this->commento;
    }
}


?>