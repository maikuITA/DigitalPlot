<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Subscription")]
class ESubscription {  // cod type period price

    // definisco il campo come chiave primaria con la prima @ORM\Id, mentre la seconda permette di far generare il valore del campo dal sistema (si può specificare la strategia di generazione)
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "subscription_id", type: "integer")]
    public int $cod;
    
    #[ORM\Column(type: "string", length: 100)]
    private string $type; 
    
    #[ORM\Column(type: "string", length: 100)]
    private string $period;
   
    #[ORM\Column(type: "float")]
    private float $price;
    
    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "subscription", cascade: ["persist"])]  // definisco il nome del campo dell'altra tabella che è chiave esterna
    private Collection $purchases; // array di purchases associati all'abbonamento
    
    public function __construct(int $type,string $period, float $price) {
        $this->setType($type);
        $this->period = $period;
        $this->price = $price;
        $this->purchases = new ArrayCollection(); 
    }

    // Set methods
    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }
    public function setType(int $type)
    {
        if ($type == READER){
            $this->type = "reader";
        }else{
            $this->type = "writer";
        }
        
    }
    public function setPeriod(string $period)
    {
        $this->period = $period;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    // Get methods
    public function getCod(){
        return $this->cod;
    }
    public function getType(){
        return $this->type;
    }
    public function getPeriod(){
        return $this->period;
    }
    public function getPrice(){
        return $this->price;
    }
    //Acquisti
    public function getPurchases(){
        return $this->purchases;
    }
    public function addPurchase(EPurchase $purchase){
        $this->purchases->add($purchase);
    }
    public function removePurchase(EPurchase $purchase){
        if ($this->purchases->contains($purchase)) {
            $this->purchases->removeElement($purchase);
        }
    }
    public function getPurchasesCount(){
        return $this->purchases->count();
    }
    public function getPurchaseById(int $index){
        foreach ($this->purchases as $purchase) {
            if ($purchase->getCod() === $index) {
                return $purchase;
            }
        }
        return null;
    }
}

