<?php


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Discount")]

class EDiscount{
    
    #[ORM\Id]
    #[ORM\Column(name: "discount_cod", type: "string", length: 100)]
    private string $cod;
    
    #[ORM\Column(type: "integer")]
    private int $price;
    
    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "discountCod", cascade: ["persist", "remove"])]
    private $purchases = [];


    public function __construct(string $cod, int $price, array $purchases = []) {
        $this->cod = $cod;
        $this->price = $price;
        $this->purchases = $purchases; // inizializza l'array di acquisti
    }

    // Set methods
    public function setCod(string $cod)
    {
        $this->cod = $cod;
    }
    public function setPrice(int $price)
    {
        $this->price = $price;
    }
    // Get methods
    public function getCod(){
        return $this->cod;
    }
    public function getPrice(){
        return $this->price;
    }
    // Acquisti
    public function getPurchases(){
        return $this->purchases;
    }
    public function addPurchase(EPurchase $purchase){
        $this->purchases[] = $purchase;
    }
    public function removeAcquisto(EPurchase $purchase){
        $key = array_search($purchase, $this->purchases);
        if ($key !== false) {
            unset($this->purchases[$key]);
        }
    }
    public function countPurchases(){
        return count($this->purchases);
    }
    public function getPurchaseById(int $index){
        if (array_key_exists($index, $this->purchases)) {
            return $this->purchases[$index];
        }
        return null;
    }

}