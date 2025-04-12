<?php

use Doctrine\ORM\Mapping as ORM;

namespace Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Recensioni")
 */
class ERecensione{

    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(type="integer") 
     */
    private int $id;
    /** 
     * @ORM\Column(type="integer") 
     */
    private int $valutazione;
    /** 
     * @ORM\Column(type="string") 
     */
    private string $commento;

    public function __construct(int $id, int $valutazione, string $commento) {
        $this->id = $id;
        $this->valutazione = $valutazione;
        $this->commento = $commento;
    }

    //Metodi set e get
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