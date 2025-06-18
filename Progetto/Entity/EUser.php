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
    private bool $admin = true;
    
    #[ORM\Column(type:"string",length:100, nullable:false) ]
    private string $name;
    
    #[ORM\Column(type:"string", length:100, nullable:false)]
    private string $surname;
    
    #[ORM\Column(type:"date", nullable:false) ]
    private DateTime $birthdate;
    
    #[ORM\Column(type:"string", length:100, nullable:false)]
    private string $birthplace;
      
    #[ORM\Column(type:"string", length:100, nullable:false) ]                                        
    private string $email;
    
    #[ORM\Column(type:"string", length:20, nullable:false)]
    private string $telephone;
    
    #[ORM\Column(type:"text")]
    private string $biography;
    
    #[ORM\OneToMany(targetEntity:"EReading", mappedBy:"userId", cascade:["persist", "remove"]) ]
    private $readings = [];
    
    #[ORM\OneToMany(targetEntity:"EPlotCard", mappedBy:"userId", cascade:["persist", "remove"])]
    private $plotCard = [];


    public function __construct(string $username, string $password,string $name, string $surname,bool $admin = false ,string $birthdate, string $birthplace, string $email, string $telephone, string $biography = "", array $readings = [], array $plotCard = [] ) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setBirthdate($birthdate);
        $this->setBirthPlace($birthplace);
        $this->setEmail($email);
        $this->setTelephone($telephone);
        $this->setBiography($biography);
        $this->setAdmin($admin);
        $this->readings = $readings;
        $this->plotCard = $plotCard;
    }
    

    //Metodi set e get
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?string {
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
    public function setBirthplace(string $birthplace): void {
        $this->birthplace = $birthplace;
    }
    public function getBirthplace(): string {
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
        $this->readings[] = $reading;
    }
    public function getReadings(): array {
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
        return "ID: " . $this->getId() . "\n" .
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