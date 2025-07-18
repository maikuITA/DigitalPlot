<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "CreditCard")]
class ECreditCard
{

    #[ORM\Id]
    #[ORM\Column(name: "card_number", type: "string")]
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
    private Collection $purchases;

    public function __construct(string $cardNumber, string $name, string $surname, string $expirationDate, string $cvv)
    {
        $this->cardNumber = $cardNumber;
        $this->name = $name;
        $this->surname = $surname;
        $this->expirationDate = new DateTime($expirationDate);
        $this->cvv = $cvv;
        $this->purchases = new ArrayCollection();
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

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }
    public function getCvv(): string
    {
        return $this->cvv;
    }

    // Methods for purchases management

    public function getPurchases()
    {
        return $this->purchases;
    }
    public function addPurchase(EPurchase $purchase)
    {
        $this->purchases->add($purchase);
    }
    public function removePurchase(EPurchase $purchase)
    {
        $key = $this->purchases->contains($purchase);
        if ($key !== false) {
            $this->purchases->removeElement($purchase);
        }
    }
    public function purchasesCount()
    {
        return $this->purchases->count();
    }
    public function getPurchaseById(int $index): ?EPurchase
    {
        foreach ($this->purchases as $purchase) {
            if ($purchase->getId() === $index) {
                return $purchase;
            }
        }
        return null;
    }
}
