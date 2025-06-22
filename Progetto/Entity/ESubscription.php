<?php

use Doctrine\ORM\Mapping as ORM;

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
    
    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "subscription", cascade: ["persist", "remove"], orphanRemoval: true)]  // definisco il nome del campo dell'altra tabella che è chiave esterna
    private $purchases = []; // array di purchases associati all'abbonamento
    
    public function __construct(int $type,string $period, float $price, array $purchases = []) {
        $this->setType($type);
        $this->period = $period;
        $this->price = $price;
        $this->purchases = $purchases; // inizializza l'array di purchases
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
        $this->purchases[] = $purchase;
    }
    public function removePurchase(EPurchase $purchase){
        $key = array_search($purchase, $this->purchases);
        if ($key !== false) {
            unset($this->purchases[$key]);
        }
    }
    public function getPurchasesCount(){
        return count($this->purchases);
    }
    public function getPurchaseById(int $index){
        if (array_key_exists($index, $this->purchases)) {
            return $this->purchases[$index];
        }
        return null;
    }
}

