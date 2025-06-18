<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "CreditCard")]
class ECreditCard{
    
    #[ORM\Id]
    #[ORM\Column( name : "card_number" ,type: "integer")]
    public int $cardNumber;
    
    #[ORM\Column(type: "string", length: 100)]
    public string $name;
    
    #[ORM\Column(type: "string", length: 100)]
    public string $surname;
    
    #[ORM\Column(type: "date")]
    public DateTime $expirationDate;
    
    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "creditCardNumber", cascade: ["persist", "remove"])]
    private $purchases = [];

    public function __construct(int $cardNumber, string $name,string $surname, string $expirationDate, array $purchases = []) {
        $this->cardNumber = $cardNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->expirationDate = new DateTime($expirationDate);
        $this->purchases = $purchases; // inizializza l'array di acquisti
    }

    // Set methods
    public function setCardNumber(int $cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setExpirationDate(string $expirationDate)
    {
        $this->expirationDate = new DateTime($expirationDate);
    }

    // Get methods
    public function getCardNumber(): int{
        return $this->cardNumber;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getSurname(): string{
        return $this->surname;
    }

    public function getExpirationDate(): DateTime{
        return $this->expirationDate;
    }
     //Acquisti
     public function getPurchases(): array{
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
    public function purchasesCount(){
        return count($this->purchases);
    }
    public function getPurchaseById(int $index){
        if (array_key_exists($index, $this->purchases)) {
            return $this->purchases[$index];
        }
        return null;
    }

}