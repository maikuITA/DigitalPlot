<?php 

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;


#[ORM\Entity]
#[ORM\Table(name: "User")]
class EUser {
    
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column(name:"user_id", type:"integer")]
    private int $id;

    #[ORM\Column(name:"privilege", type:"integer", nullable:false)]
    private int $privilege = BASIC;

    //----------------CREDENTIALS----------------
   
    #[ORM\Column(type:"string",nullable:false,unique:true)]
    private string $username;
    
    #[ORM\Column(type:"string", nullable:false)]
    private string $password;
    
    //-----------------REGISTRY-----------------

    #[ORM\Column(type:"string",length:100, nullable:false) ]
    private string $name;
    
    #[ORM\Column(type:"string", length:100, nullable:false)]
    private string $surname;
    
    #[ORM\Column(type:"date", nullable:false) ]
    private DateTime $birthdate;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $country;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $birthplace;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $province;

    #[ORM\Column(type:"string", length:5, nullable:false)]
    private string $zipCode;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $streetAddress;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $streetNumber;
    
    #[ORM\Column(type:"string", length:100, nullable:false) ]                                        
    private string $email;
    
    #[ORM\Column(type:"string", length:20, nullable:false)]
    private string $telephone;
    
    #[ORM\Column(type:"text", nullable:true)]
    private string $biography;
    
    #[ORM\Column(type:"blob", nullable:true)]
    private mixed $profilePicture;

    //-----------------BASIC-----------------

    #[ORM\OneToMany(targetEntity:"EReading", mappedBy:"user", cascade:["persist", "remove"]) ]
    private $readings = [];
    
    #[ORM\OneToMany(targetEntity:"EPlotCard", mappedBy:"user", cascade:["persist", "remove"])]
    private $plotCard = [];

    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "subscriber", cascade: ["persist", "remove"])]
    private $purchases = [];

    //-----------------READER-----------------

    // definisco il name del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "follower", cascade: ["persist", "remove"])]
    private $followers = [];
    
    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "following", cascade: ["persist", "remove"])]
    private $following = [];

    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "subscriber", cascade: ["persist", "remove"])]
    private $reviews = [];

    //-----------------WRITER-----------------

    // definisco il nome del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EArticle", mappedBy: "writer", cascade: ["persist", "remove"])]
    private $articles = [];

    //-----------------ADMIN-----------------


    //-----------------CONSTRUCT-----------------

    public function __construct(int $privilege,
                                string $username, 
                                string $password,
                                string $name, 
                                string $surname,
                                string $birthdate, 
                                string $country,
                                string $birthplace, 
                                string $province,
                                string $zipCode,
                                string $streetAddress, 
                                string $streetNumber,
                                string $email, 
                                string $telephone, 
                                string $biography = "", 
                                mixed $profilePicture = null,
                                $readings = [], 
                                $plotCard = [], 
                                $purchases = [],
                                $following = [], 
                                $followers = [], 
                                $reviews = [], 
                                $articles = []
                                ) {
        $this->setPrivilege($privilege);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthdate($birthdate);
        $this->setCountry($country);
        $this->setBirthPlace($birthplace);
        $this->setProvince($province);
        $this->setZipCode($zipCode);
        $this->setStreetAddress($streetAddress);
        $this->setStreetNumber($streetNumber);
        $this->setEmail($email);
        $this->setTelephone($telephone);
        $this->setBiography($biography);
        $this->setProfilePicture($profilePicture);
        $this->readings = $readings;
        $this->plotCard[0] = $plotCard;
        $this->purchases = $purchases;
        $this->following = $following;
        $this->followers = $followers;
        $this->reviews = $reviews;
        $this->articles = $articles;
    }
    

    //Metodi set e get
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setPrivilege(int $privilege): void {
        $this->privilege = $privilege;
    }
    public function getPrivilege(): int {
        return $this->privilege;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getPassword(): string {
        return $this->password;
    }    
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function getName(): string {
        return $this->name;
    }
    public function setSurname(string $surname): void {
        $this->surname = $surname;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function setBirthdate(string $birthdate): void {
        $this->birthdate = new DateTime($birthdate);
    }
    public function getBirthdate(): DateTime {
        return $this->birthdate;
    }
    public function setCountry(string $country): void {
        $this->country = $country;
    }
    public function getCountry(): string {
        return $this->country;
    }
    public function setBirthPlace(string $birthplace): void {
        $this->birthplace = $birthplace;
    }
    public function getBirthPlace(): string {
        return $this->birthplace;
    }
    public function setProvince(string $province): void {
        $this->province = $province;
    }
    public function getProvince(): string {
        return $this->province;
    }
    public function setZipCode(string $zipCode): void {
        $this->zipCode = $zipCode;
    }
    public function getZipCode(): string {
        return $this->zipCode;
    }
    public function setStreetAddress(string $streetAddress): void {
        $this->streetAddress = $streetAddress;
    }
    public function getStreetAddress(): string {
        return $this->streetAddress;
    }
    public function setStreetNumber(string $streetNumber): void {
        $this->streetNumber = $streetNumber;
    }
    public function getStreetNumber(): string {
        return $this->streetNumber;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }
    public function getTelephone(): string {
        return $this->telephone;
    }
    public function setBiography(string $biography): void {
        $this->biography = $biography;
    }
    public function getBiography(): string {
        return $this->biography;
    }

    public function setProfilePicture($profilePicture): void {
        $this->profilePicture = $profilePicture;
    }

    /**
     * Returns the profile picture as a base64 encoded string.
     * If the profile picture is a resource, it reads the contents and encodes it.
     * If it's already a string, it encodes it directly.
     */
    public function getEncodedData(): ?string {
        if($this->profilePicture === null){
            return null; // Gestione del caso in cui non sia stata impostata alcuna immagine
        }
        if(is_resource($this->profilePicture)){
            $data = stream_get_contents($this->profilePicture);
            return base64_encode($data);
        }else{
            return base64_encode($this->profilePicture);
        }
        
    }

    //-----------------BASIC-----------------


    //readings methods
    public function addReading(EReading $reading): void {
        $this->plotCard[0]->addPoints(POINTS);
        $this->readings[] = $reading;
    }
    public function getReadings(): mixed {
        return $this->readings;
    }
    public function removeReading(EReading $reading): void {
        foreach ($this->readings as $key => $value) {
            if ($value->getCod() === $reading->getCod()) {
                unset($this->readings[$key]);
            }
        }
    }
    public function getReadingById( int $id): ?EReading {
        foreach ($this->readings as $reading) {
            if ($reading->getCod() === $id) {
                return $reading;
            }
        }
        return null;
    }
    public function countReadings(): int {
        return count($this->readings);
    }

    //PlotCard methods
    public function addPlotCard(EPlotCard $plotCard): void {
        $this->plotCard[0] = $plotCard;
    }
    public function getPlotCard(): EPlotCard {
        return $this->plotCard[0];
    }
    public function removePlotCard(): void {
        array_shift($this->plotCard);
    }

    //purchases methods
    public function addPurchase(EPurchase $purchase): void {
        array_push($this->purchases, $purchase);
    }
    public function getPurchases(): array {
        return $this->purchases;
    }
    public function getPurchaseById(int $id): ?EPurchase {
        foreach ($this->purchases as $purchase) {
            if ($purchase->getId() === $id) {
                return $purchase;
            }
        }
        return null;
    }
    public function removePurchase(int $id): void {
        foreach ($this->purchases as $key => $purchase) {
            if ($purchase->getId() === $id) {
                unset($this->purchases[$key]);
                break;
            }
        }
    }
    public function getPurchaseCount(): int {
        return count($this->purchases);
    }

    //-----------------READER-----------------

     // followers

    public function setFollowers(EUser $follower): void{
        array_push($this->followers, $follower);
    }
    public function getFollowers(): array{
        return $this->followers;
    }
    public function getFollower(int $index): EUser{
        return $this->followers[$index];
    }
    public function getNumFollowers(): int{
        return count($this->followers);
    }
    public function removeFollower(EUser $follower): void{
        foreach($this->followers as $key => $value){
            if($value == $follower){
                unset($this->followers[$key]);
            }
        }
    }
    public function getFollowerById(int $id): ?EUser{
        foreach($this->followers as $follower){
            if($follower->getId() == $id){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByUsername(string $username): ?EUser{
        foreach($this->followers as $follower){
            if($follower->getUsername() == $username){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByName(string $name): ?EUser{
        foreach($this->followers as $follower){
            if($follower->getName() == $name){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerBySurname(string $surname): ?EUser{
        foreach($this->followers as $follower){
            if($follower->getSurname() == $surname){
                return $follower;
            }
        }
        return null;
    }

    // following methods
    public function addFollowing(EUser $following): void{
        array_push($this->following, $following);
    }
    public function getFollowing(): array{
        return $this->following;
    }

    public function getNumFollowing(): int{
        return count($this->following);
    }

    //reviews methods
    public function addReview(EReview $review): void {
        array_push($this->reviews, $review);
    }
    public function getReviews(): array {
        return $this->reviews;
    }
    public function getReviewById(int $id): ?EReview {
        foreach ($this->reviews as $review) {
            if ($review->getId() === $id) {
                return $review;
            }
        }
        return null;
    }
    public function removeReview(int $id): void {
        foreach ($this->reviews as $key => $review) {
            if ($review->getId() === $id) {
                unset($this->reviews[$key]);
                break;
            }
        }
    }
    public function getReviewCount(): int {
        return count($this->reviews);
    }

    //-----------------WRITER-----------------

    // articles methods
    public function addArticle(EArticle $article): void{
        array_push($this->articles, $article);
    }
    public function getArticles(){
        return $this->articles;
    }
    public function getArticleById(int $index): EArticle{
        return $this->articles[$index];
    }
    public function getNumArticles(): int{
        $numeroArticles = count($this->articles);
        return $numeroArticles;
    }
    public function removeArticle(EArticle $article): void{
        foreach($this->articles as $key => $value){
            if($value == $article){
                unset($this->articles[$key]);
            }
        }
    }
    public function __toString()
    {
        return "Username: " . $this->getUsername() . "\n" .
               "Name: " . $this->getName() . "\n" .
               "Surname: " . $this->getSurname() . "\n" .
               "Data di Nascita: " . $this->getBirthdate()->format('Y-m-d') . "\n" .
               "Luogo di Nascita: " . $this->getBirthplace() . "\n" .
               "Email: " . $this->getEmail() . "\n" .
               "Telephone: " . $this->getTelephone() . "\n" .
               "Biography: " . $this->getBiography() . "\n";
    }
}


?>