<?php


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"PlotCard")]
class EPlotCard{

    #[ORM\Id]            
    #[ORM\GeneratedValue(strategy: "IDENTITY")]  
    #[ORM\Column(name: "card_cod", type: "integer")] 
    private int $cod;
    #[ORM\Column(type: "integer")] 
    private int $points;
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "PlotCard")]
    #[ORM\JoinColumn(name : "fk_utente", referencedColumnName : "user_id", nullable:false, unique: true)] // definizione chiave esterna
    private EUser $idUser;

    public function __construct(int $points, EUser $idUser ) {
        $this->setPoints($points);
        $this->idUser = $idUser;
    }
    //Metodo per aggiungere points
    public function addPoints(int $points): void {
        $this->points += $points;
    }
    //Metodo per sottrarre points
    public function subPoints(int $points) : void{
        if ($this->points - $points >= 0) {
            $this->points -= $points;
        } else {
            throw new \Exception("Non puoi sottrarre più points di quelli disponibili.");
        }
    }



    //Metodi set e get
    public function setId(int $cod) : void{
        $this->cod = $cod;
    }
    public function getCode(): int {
        return $this->cod;
    }
    public function setPoints(int $points) {
        $this->points = $points;
    }
    public function getPoints(): int {
        return $this->points;
    }
    public function setIdUser(EUser $idUser) {
        $this->idUser = $idUser;
    }
    public function getIdUser(): EUser {
        return $this->idUser;
    }

    public function __toString(): string {
        return "Points: " . $this->points . ", ID Utente: " . $this->idUser;
    }
}


?>