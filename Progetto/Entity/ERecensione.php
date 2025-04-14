<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Recensione")
 */
class ERecensione{

    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(name="id_recensione", type="integer") 
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

    /** 
     * @ORM\Column(type="integer") 
     */
    private int $idUtente;
    /** 
     * @ORM\Column(type="integer") 
     */
    private int $idArticolo;

    public function __construct(int $id, int $valutazione, string $commento, int $idUtente, int $idArticolo) {
        $this->id = $id;
        $this->valutazione = $valutazione;
        $this->commento = $commento;
        $this->idUtente = $idUtente;
        $this->idArticolo = $idArticolo;
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