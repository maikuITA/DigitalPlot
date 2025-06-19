<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table("Purchase")]
class EPurchase{
    
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id_purchase", type: "integer")]
    private int $cod;
    
    #[ORM\Column(name: "purchase_date", type: "date")]
    private DateTime $purchaseDate;
    
    #[ORM\ManyToOne(targetEntity: "ESubscriber", inversedBy: "purchases")]
    #[ORM\JoinColumn(name: "fk_subscriber", referencedColumnName: "user_id", nullable: true)]
    private ESubscriber $subscriber;
    
    #[ORM\ManyToOne(targetEntity: "EDiscount", inversedBy: "purchases")]
    #[ORM\JoinColumn(name: "fk_discount", referencedColumnName: "discount_cod", nullable: true)] // definizione chiave esterna
    private ?EDiscount $discountCod;

    #[ORM\ManyToOne(targetEntity: "ESubscription", inversedBy: "purchases")]
    #[ORM\JoinColumn(name: "fk_subscription", referencedColumnName: "subscription_id", nullable: false)] // definizione chiave esterna
    private ESubscription $subscription;
     
    #[ORM\ManyToOne(targetEntity: "ECreditCard", inversedBy: "purchases")]
    #[ORM\JoinColumn(name: "fk_card", referencedColumnName: "card_number", nullable: false)] // definizione chiave esterna
    private ECreditCard $creditCardNumber;
     
    #[ORM\Column(name: "subtotal", type: "float")]
    private float $subTotal;


    public function __construct( string $purchaseDate, ESubscriber $subscriber ,ESubscription $subscription, ?EDiscount $discount, ECreditCard $card) {
        $this->subscriber = $subscriber;
        $this->subscription = $subscription;
        $this->purchaseDate = new DateTime($purchaseDate);
        $this->discountCod = $discount;
        $this->creditCardNumber = $card;
        $this->subTotal = $this->calculateSubTotal($this->subscription, $this->discountCod);
    }
    
    // Set methods
    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }
    public function setPurchaseDate(string $purchaseDate)
    {
        $this->purchaseDate = new DateTime($purchaseDate);
    }
    public function setDiscountCode(EDiscount $discountCod)
    {
        $this->discountCod = $discountCod;
    }    
    public function setCard(ECreditCard $card)
    {
        $this->creditCardNumber = $card;
    }
    public function setSubscription(ESubscription $subscription): void
    {
        $this->subscription = $subscription;
    }
    public function setSubscriber(ESubscriber $subscriber){
        $this->subscriber = $subscriber;
    }
    
    // Get methods
    public function getCod(): int{
        return $this->cod;
    }
    public function getPurchaseDate(): DateTime{
        return $this->purchaseDate;
    }
    public function getSubTotal(): float{
        $this->subTotal = $this->calculateSubTotal($this->subscription, $this->discountCod);
        return $this->subTotal;
    }
    public function getDiscountCod(): EDiscount{
        return $this->discountCod;
    }
    public function getCard(): ECreditCard{
        return $this->creditCardNumber;
    }
    public function getSubscription(): ESubscription
    {
        return $this->subscription;
    }
    public function getSubscriber(): ESubscriber
    {
        return $this->subscriber;
    }


    public function calculateSubTotal(ESubscription $subscription, EDiscount $discount): float
    {
        if ($discount === null){
            return $subscription->getPrice();
        }
        $priceA = $subscription->getPrice();
        $priceS = $discount->getPrice();
        $sub = $priceA - $priceS;
        return $sub;
    }
}