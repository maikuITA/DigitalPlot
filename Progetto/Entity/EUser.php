<?php

use Doctrine\ORM\Mapping as ORM; // allows to use annotations for ORM mapping
use Doctrine\Common\Collections\ArrayCollection; // doctrine class which implements the Collection interface and allow you to represent efficiently array of objects
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "User")]
class EUser
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "user_id", type: "integer")]
    private int $id;

    #[ORM\Column(name: "privilege", type: "integer", nullable: false)]
    private int $privilege;

    //----------------CREDENTIALS----------------

    #[ORM\Column(type: "string", nullable: false, unique: true)]
    private string $username;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private string $password;

    //-----------------REGISTRY-----------------

    #[ORM\Column(type: "string", length: 100, nullable: false)]
    private string $name;

    #[ORM\Column(type: "string", length: 100, nullable: false)]
    private string $surname;

    #[ORM\Column(type: "date", nullable: false)]
    private DateTime $birthdate;

    #[ORM\Column(type: "string", length: 40, nullable: false)]
    private string $country;

    #[ORM\Column(type: "string", length: 40, nullable: false)]
    private string $birthplace;

    #[ORM\Column(type: "string", length: 40, nullable: false)]
    private string $province;

    #[ORM\Column(type: "string", length: 5, nullable: false)]
    private string $zipCode;

    #[ORM\Column(type: "string", length: 40, nullable: false)]
    private string $streetAddress;

    #[ORM\Column(type: "string", length: 40, nullable: false)]
    private string $streetNumber;

    #[ORM\Column(type: "string", length: 100, nullable: false)]
    private string $email;

    #[ORM\Column(type: "string", length: 20, nullable: false)]
    private string $telephone;

    #[ORM\Column(type: "text", nullable: true)]
    private string $biography;

    #[ORM\Column(type: "blob", nullable: true)]
    private mixed $profilePicture;

    //-----------------BASIC-----------------

    // cascade persist -> if you save the user, it will also save the related entities
    // cascade remove -> if you delete the user, it will also delete the related entities

    #[ORM\OneToMany(targetEntity: "EReading", mappedBy: "user", cascade: ["persist", "remove"])]
    private Collection $readings;

    #[ORM\OneToMany(targetEntity: "EPlotCard", mappedBy: "user", cascade: ["persist", "remove"])]
    private Collection $plotCard;

    #[ORM\OneToMany(targetEntity: "EPurchase", mappedBy: "subscriber", cascade: ["persist", "remove"])]
    private Collection $purchases;

    //-----------------READER-----------------

    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "follower", cascade: ["persist", "remove"])]
    private Collection $followers;

    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "following", cascade: ["persist", "remove"])]
    private Collection $following;

    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "subscriber", cascade: ["persist", "remove"])]
    private Collection $reviews;

    //-----------------WRITER-----------------

    // definisco il nome del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EArticle", mappedBy: "writer", cascade: ["persist", "remove"])]
    private Collection $articles;

    //-----------------ADMIN-----------------


    //-----------------CONSTRUCT-----------------

    public function __construct(
        int $privilege = BASIC,
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
        mixed $profilePicture = null
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
        $this->readings = new ArrayCollection();
        $this->plotCard = new ArrayCollection();
        $this->purchases = new ArrayCollection();
        $this->following = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }


    //Metodi set e get
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPrivilege(int $privilege): void
    {
        $this->privilege = $privilege;
    }
    public function getPrivilege(): int
    {
        return $this->privilege;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    // password_bcrypt represents an algorithm for hashing passwords long 60 characters

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }
    public function setBirthdate(string $birthdate): void
    {
        $this->birthdate = new DateTime($birthdate);
    }
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
    public function setBirthPlace(string $birthplace): void
    {
        $this->birthplace = $birthplace;
    }
    public function getBirthPlace(): string
    {
        return $this->birthplace;
    }
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }
    public function getProvince(): string
    {
        return $this->province;
    }
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
    public function getZipCode(): string
    {
        return $this->zipCode;
    }
    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }
    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }
    public function setStreetNumber(string $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }
    public function getStreetNumber(): string
    {
        return $this->streetNumber;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }
    public function getTelephone(): string
    {
        return $this->telephone;
    }
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }
    public function getBiography(): string
    {
        return $this->biography;
    }

    public function setProfilePicture($profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    /**
     * Returns the profile picture as a base64 encoded string.
     * If the profile picture is a resource, it reads the contents and encodes it.
     * If it's already a string, it encodes it directly.
     */
    public function getEncodedData(): ?string
    {
        if ($this->profilePicture === null) {
            return null; // Gestione del caso in cui non sia stata impostata alcuna immagine
        }
        if (is_resource($this->profilePicture)) {  // if the picture is a resource (PDO returns a stream, the picture is uploaded as a flow of bytes, so the variable is the pointer to the flow)
            $data = stream_get_contents($this->profilePicture);  // it takes the contents of the resource
            return base64_encode($data); // base64 transforms binary data into a string
        } else {
            return base64_encode($this->profilePicture);
        }
    }

    //-----------------BASIC-----------------


    //readings methods
    public function addReading(EReading $reading): void
    {
        $this->readings->add($reading);
    }
    public function getReadings()
    {
        return $this->readings;
    }
    public function removeReading(EReading $reading): void
    {
        if ($this->readings->contains($reading)) {
            $this->readings->removeElement($reading);
        }
    }
    public function getReadingById(int $id): ?EReading
    {
        foreach ($this->readings as $reading) {
            if ($reading->getCod() === $id) {
                return $reading;
            }
        }
        return null;
    }
    public function countReadings(): int
    {
        return $this->readings->count();
    }

    public function getReaddenArticles()
    {
        $articles = new ArrayCollection();
        foreach ($this->readings as $reading) {
            $articles->add($reading->getArticle());
        }
        return $articles;
    }

    //PlotCard methods
    public function addPlotCard(EPlotCard $plotCard): void
    {
        $this->plotCard->add($plotCard);
    }
    public function getPlotCard()
    {
        return $this->plotCard->first();
    }
    public function removePlotCard(): void
    {
        $this->plotCard->clear();
    }

    //purchases methods
    public function addPurchase(EPurchase $purchase): void
    {
        $this->purchases->add($purchase);
    }
    public function getPurchases()
    {
        return $this->purchases;
    }
    public function getPurchaseById(int $id): ?EPurchase
    {
        foreach ($this->purchases as $purchase) {
            if ($purchase->getId() === $id) {
                return $purchase;
            }
        }
        return null;
    }
    public function removePurchase(EPurchase $id): void
    {
        if ($this->purchases->contains($id)) {
            $this->purchases->removeElement($id);
        }
    }
    public function getPurchaseCount(): int
    {
        return $this->purchases->count();
    }

    //-----------------READER-----------------

    // followers

    public function addFollower(EFollow $follower): void
    {
        $this->followers->add($follower);
    }
    public function getFollowers()
    {
        return $this->followers;
    }
    public function getFollowerById(int $index): ?EFollow
    {
        foreach ($this->followers as $follower) {
            if ($follower->getFollower()->getId() == $index) {
                return $follower;
            }
        }
        return null;
    }
    public function getNumFollowers(): int
    {
        return $this->followers->count();
    }
    public function removeFollower(EFollow $follower): void
    {
        if ($this->followers->contains($follower)) {
            $this->followers->removeElement($follower);
        }
    }

    // following 

    public function addFollowing(EFollow $following): void
    {
        $this->following->add($following);
    }
    public function getFollowing()
    {
        return $this->following;
    }

    public function getNumFollowing(): int
    {
        return $this->following->count();
    }
    public function getFollowingById(int $id): ?EFollow
    {
        foreach ($this->following as $follower) {
            if ($follower->getFollower()->getId() == $id) {
                return $follower;
            }
        }
        return null;
    }
    public function removeFollowing(EFollow $follower): void
    {
        if ($this->following->contains($follower)) {
            $this->following->removeElement($follower);
        }
    }

    //reviews 

    public function addReview(EReview $review): void
    {
        $this->reviews->add($review);
    }
    public function getReviews()
    {
        return $this->reviews;
    }
    public function getReviewById(int $id): ?EReview
    {
        foreach ($this->reviews as $review) {
            if ($review->getId() === $id) {
                return $review;
            }
        }
        return null;
    }
    public function removeReview(EReview $review): void
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
        }
    }
    public function getReviewCount(): int
    {
        return $this->reviews->count();
    }

    //-----------------WRITER-----------------

    // articles

    public function addArticle(EArticle $article): void
    {
        $this->articles->add($article);
    }
    public function getArticles()
    {
        return $this->articles;
    }
    public function getArticleById(int $index): ?EArticle
    {
        foreach ($this->articles as $article) {
            if ($article->getId() == $index) {
                return $article;
            }
        }
        return null;
    }
    public function getNumArticles(): int
    {
        return $this->articles->count();
    }
    public function removeArticle(EArticle $article): void
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
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
