<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="PlotCards")
 */
class EPlotCard{

    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(type="integer") 
     */
    private int $id;
    /**  
     * @ORM\Column(type="integer") 
     */
    private int $punti;

    public function __construct(int $id, int $punti) {
        $this->setId($id);
        $this->setPunti($punti);
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
}


?>