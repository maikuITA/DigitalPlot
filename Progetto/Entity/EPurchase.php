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

    #[ORM\Column(name: "expire_date", type: "date")]
    private DateTime $expireDate;
    
    //---------------Billing Address----------------

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $country;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $city;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $province;

    #[ORM\Column(type:"string", length:5, nullable:false)]
    private string $zipCode;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $billingAddress;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $streetNumber;

    //---------------Relationships-------------------

    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "purchases", cascade: ["persist","remove"])]
    #[ORM\JoinColumn(name: "fk_subscriber", referencedColumnName: "user_id", nullable: true)]
    private EUser $subscriber;

    #[ORM\ManyToOne(targetEntity: "ESubscription", inversedBy: "purchases", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: "fk_subscription", referencedColumnName: "subscription_id", nullable: false)] // definizione chiave esterna
    private ESubscription $subscription;
     
    #[ORM\ManyToOne(targetEntity: "ECreditCard", inversedBy: "purchases", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: "fk_card", referencedColumnName: "card_number", nullable: false)] // definizione chiave esterna
    private ECreditCard $creditCardNumber;
     
    #[ORM\Column(name: "subtotal", type: "float")]
    private float $subTotal;


    public function __construct(string $purchaseDate, 
                                string $expireDate, 
                                string $country, 
                                string $city, 
                                string $province, 
                                string $zipCode,
                                string $billingAddress,
                                string $streetNumber,
                                EUser $subscriber, 
                                ESubscription $subscription, 
                                ECreditCard $card) {
        $this->purchaseDate = new DateTime($purchaseDate);
        $this->expireDate = new DateTime($expireDate);
        $this->country = $country;
        $this->city = $city;
        $this->province = $province;
        $this->zipCode = $zipCode;
        $this->billingAddress = $billingAddress;
        $this->streetNumber = $streetNumber;
        $this->subscriber = $subscriber;
        $this->subscription = $subscription;
        $this->creditCardNumber = $card;
        $this->subTotal = $subscription->getPrice() - self::calculateDiscount($this->subscription, $subscriber->getPlotCard()->getPoints());
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
    public function setExpireDate(string $expireDate)
    {
        $this->expireDate = new DateTime($expireDate);
    }   
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }
    public function setCity(string $city): void
    {
        $this->city = $city;
    }
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
    public function setBillingAddress(string $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }
    public function setStreetNumber(string $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }
    
    public function setSubscription(ESubscription $subscription): void
    {
        $this->subscription = $subscription;
    }
    public function setSubscriber(EUser $subscriber){
        $this->subscriber = $subscriber;
    }
    public function setCard(ECreditCard $card)
    {
        $this->creditCardNumber = $card;
    }
    
    // Get methods
    public function getCod(): int{
        return $this->cod;
    }
    public function getPurchaseDate(): DateTime{
        return $this->purchaseDate;
    }
    public function getExpireDate(): DateTime{
        return $this->expireDate;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
    public function getCity(): string
    {
        return $this->city;
    }
    public function getProvince(): string
    {
        return $this->province;
    }
    public function getZipCode(): string
    {
        return $this->zipCode;
    }
    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }
    public function getStreetNumber(): string
    {
        return $this->streetNumber;
    }
    public function getSubscription(): ESubscription
    {
        return $this->subscription;
    }
    public function getSubscriber(): EUser
    {
        return $this->subscriber;
    }
    public function getCard(): ECreditCard{
        return $this->creditCardNumber;
    }
     public function getSubTotal(): float{
        return $this->subTotal;
    }

    public static function calculateDiscount(ESubscription $subscription, int $points): float
    {
        $price = $subscription->getPrice();
        $difference = $price - ($points * POINTS_MULTIPLIER);
        $result = $points * POINTS_MULTIPLIER;
        if ($difference > 0) {
            return $result; 
        } else{
            return $price;
        }
    }
}