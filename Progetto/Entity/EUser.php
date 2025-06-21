<?php 

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;


#[ORM\Entity]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["subsciber" => "ESubscriber", "reader" => "EReader", "writer" => "EWriter", "user" => "EUser"])]  // definisco i tipi di utenti
#[ORM\Table(name: "User")]
class EUser {
    
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column(name:"user_id", type:"integer")]
    private int $id;
   
    #[ORM\Column(type:"string",nullable:false,unique:true)]
    private string $username;
    
    #[ORM\Column(type:"string", nullable:false)]
    private string $password;
    
    #[ORM\Column(name:"admin",type:"boolean")]
    private bool $admin = false;
    
    #[ORM\Column(type:"string",length:100, nullable:false) ]
    private string $name;
    
    #[ORM\Column(type:"string", length:100, nullable:false)]
    private string $surname;
    
    
    #[ORM\Column(type:"date", nullable:false) ]
    private DateTime $birthdate;

    #[ORM\Column(type:"string", length:40, nullable:false)]
    private string $streetAddress;
    
    #[ORM\Column(type:"string", length:100, nullable:false)]
    private string $birthplace;
      
    #[ORM\Column(type:"string", length:100, nullable:false) ]                                        
    private string $email;
    
    #[ORM\Column(type:"string", length:20, nullable:false)]
    private string $telephone;
    
    #[ORM\Column(type:"text", nullable:true)]
    private string $biography;
    
    #[ORM\Column(type:"blob", nullable:true)]
    private mixed $profilePicture;

    #[ORM\OneToMany(targetEntity:"EReading", mappedBy:"user", cascade:["persist", "remove"]) ]
    private $readings = [];
    
    #[ORM\OneToMany(targetEntity:"EPlotCard", mappedBy:"user", cascade:["persist", "remove"])]
    private $plotCard = [];


    public function __construct(string $username, string $password,string $name, string $surname,bool $admin = false ,string $birthdate, string $streetAddress, string $birthplace, string $email, string $telephone, string $biography = "", $plotCard = [], array $readings = [], mixed $profilePicture = null) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthdate($birthdate);
        $this->setStreetAddress($streetAddress);
        $this->setBirthPlace($birthplace);
        $this->setEmail($email);
        $this->setTelephone($telephone);
        $this->setBiography($biography);
        $this->setAdmin($admin);
        $this->readings = $readings;
        $this->plotCard[0] = $plotCard;
        $this->profilePicture = $profilePicture;
    }
    

    //Metodi set e get
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
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

    public function getAdmin(): bool {
        return $this->admin;
    }
    public function setAdmin(bool $admin): void {
        $this->admin = $admin;
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
    public function setStreetAddress(string $streetAddress): void {
        $this->streetAddress = $streetAddress;
    }
    public function getStreetAddress(): string {
        return $this->streetAddress;
    }
    public function setBirthPlace(string $birthplace): void {
        $this->birthplace = $birthplace;
    }
    public function getBirthPlace(): string {
        return $this->birthplace;
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
    // Metodi per le readings
    public function addReading(EReading $reading): void {
        $this->plotCard[0]->addPoints(POINTS);
        $this->readings[] = $reading;
    }
    public function getReadings(): ?array {
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


    // Metodi per le PlotCard
    public function addPlotCard(EPlotCard $plotCard): void {
        $this->plotCard[0] = $plotCard;
    }
    public function getPlotCard(): EPlotCard {
        return $this->plotCard[0];
    }
    public function removePlotCard(): void {
        array_shift($this->plotCard);
    }
    public function __toString()
    {
        return // "ID: " . $this->getId() . "\n" .
               "Username: " . $this->getUsername() . "\n" .
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