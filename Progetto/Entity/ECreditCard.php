<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "CreditCard")]
class ECreditCard{
    
    #[ORM\Id]
    #[ORM\Column( name : "card_number" ,type: "string")]
    public string $cardNumber;
    
    #[ORM\Column(type: "string", length: 100)]
    public string $name;
    
    #[ORM\Column(type: "string", length: 100)]
    public string $surname;
    
    #[ORM\Column(type: "date")]
    public DateTime $expirationDate;

    #[ORM\Column(type: "string", length: 3)]
    public string $cvv;
    
    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "creditCardNumber", cascade: ["persist", "remove"])]
    private $purchases = [];

    public function __construct(string $cardNumber, string $name,string $surname, string $expirationDate, string $cvv, array $purchases = []) {
        $this->cardNumber = $cardNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->expirationDate = new DateTime($expirationDate);
        $this->cvv = $cvv; // inizializza il CVV
        $this->purchases = $purchases; // inizializza l'array di acquisti
    }

    // Set methods
    public function setCardNumber(string $cardNumber)
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
    public function setCvv(string $cvv)
    {
        $this->cvv = $cvv;
    }

    // Get methods
    public function getCardNumber(): string{
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
    public function getCvv(): string{
        return $this->cvv;
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