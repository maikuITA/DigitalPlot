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
    #[ORM\JoinColumn(name : "fk_user", referencedColumnName : "user_id", nullable:false, unique: true)] // definizione chiave esterna
    private EUser $userId;

    public function __construct(int $points, EUser $userId ) {
        $this->setPoints($points);
        $this->userId = $userId;
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
            throw new \Exception("You can't go below zero.");
        }
    }



    //Metodi set e get
    public function setId(int $cod) : void{
        $this->cod = $cod;
    }
    public function getCod(): int {
        return $this->cod;
    }
    public function setPoints(int $points) {
        $this->points = $points;
    }
    public function getPoints(): int {
        return $this->points;
    }
    public function setUserId(EUser $userId) {
        $this->userId = $userId;
    }
    public function getUserid(): EUser {
        return $this->userId;
    }

    public function __toString(): string {
        return "Points: " . $this->points . ", User ID: " . $this->userId;
    }
}


?>