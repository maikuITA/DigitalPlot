<?php


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"PlotCard")]
class EPlotCard{

    #[ORM\Id]            
    #[ORM\GeneratedValue(strategy: "IDENTITY")]  
    #[ORM\Column(name: "id_card", type: "integer")] 
    private int $id;
    #[ORM\Column(type: "integer")] 
    private int $punti;
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "PlotCard")]
    #[ORM\JoinColumn(name : "fk_utente", referencedColumnName : "id_utente", nullable:false)] // definizione chiave esterna
    private EUser $idUser;

    public function __construct(int $punti, EUser $idUser ) {
        $this->setPunti($punti);
        $this->idUser = $idUser;
    }
    //Metodo per aggiungere punti
    public function addPunti(int $punti): void {
        $this->punti += $punti;
    }
    //Metodo per sottrarre punti
    public function subPunti(int $punti) : void{
        if ($this->punti - $punti >= 0) {
            $this->punti -= $punti;
        } else {
            throw new \Exception("Non puoi sottrarre più punti di quelli disponibili.");
        }
    }



    //Metodi set e get
    public function setId(int $id) : void{
        $this->id = $id;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setPunti(int $punti) {
        $this->punti = $punti;
    }
    public function getPunti(): int {
        return $this->punti;
    }
    public function setIdUser(EUser $idUser) {
        $this->idUser = $idUser;
    }
    public function getIdUser(): EUser {
        return $this->idUser;
    }

    public function __toString(): string {
        return "Punti: " . $this->punti . ", ID Utente: " . $this->idUser;
    }
}


?>