<?php 
namespace Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Smarty\Data;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @DiscriminatorColumn(name="tipo", type="string")
 * @DiscriminatorMap({"abbonato" = "Abbonato", "lettore" = "Lettore", "scrittore" = "Scrittore", "progettista" = "Progettista"})  // definisco i tipi di utenti
 * @ORM\Table(name="Utente")
 */
class EUser {
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(name="id_utente", type="integer") 
     */
    private int $id;
    /** 
     * @ORM\Column(type="string", nullable=false, unique=true) 
     */
    private string $username;
    /** 
     * @ORM\Column(type="string", nullable=false) 
     */
    private string $password;
    /** 
     * @ORM\Column(type="boolean") 
     */
    private bool $status = true;
    /** 
     * @ORM\Column(type="string",length=100, nullable=false) 
     */
    private string $nome;
    /** 
     * @ORM\Column(type="string", length=100, nullable=false) 
     */
    private string $cognome;
    /** 
     * @ORM\Column(type="date", nullable=false) 
     */
    private DateTime $dataNascita;
    /** 
     * @ORM\Column(type="string", length=100, nullable=false) 
     */
    private string $luogoNascita;
    /** 
     * @ORM\Column(type="string", length=100, nullable=false) 
     */                                           
    private string $email;
    /** 
     * @ORM\Column(type="string", length=20, nullable=false) 
     */  
    private string $telefono;
    /** 
     * @ORM\Column(type="text") 
     */
    private string $biografia;
    /** 
     * @ORM\OneToMany(targetEntity="Lettura", mappedBy="id_utente", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */
    private $letture = [];
    /** 
     * @ORM\OneToMany(targetEntity="PlotCard", mappedBy="idUser", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
     */
    private $PlotCard = [];


    public function __construct(string $username, string $password, string $nome, string $cognome, string $dataNascita, string $luogoNascita, string $email, string $telefono, string $biografia = "", array $letture = [], array $PlotCard = []) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setNome($nome);
        $this->setCognome($cognome);
        $this->setDataNascita($dataNascita);
        $this->setLuogoNascita($luogoNascita);
        $this->setEmail($email);
        $this->setTelefono($telefono);
        $this->setBiografia($biografia);
        $this->letture = $letture;
        $this->PlotCard = $PlotCard; 
    }
    

    //Metodi set e get
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setUsername(int $username) {
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

    public function getStatus(): bool {
        return $this->status;
    }
    public function setStatus(bool $status): void {
        $this->status = $status;
    }
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }
    public function getNome(): string {
        return $this->nome;
    }
    public function setCognome(string $cognome): void {
        $this->cognome = $cognome;
    }
    public function getCognome(): string {
        return $this->cognome;
    }
    public function setDataNascita(string $dataNascita): void {
        $this->dataNascita = new DateTime($dataNascita);
    }
    public function getDataNascita(): DateTime {
        return $this->dataNascita;
    }
    public function setLuogoNascita(string $luogoNascita): void {
        $this->luogoNascita = $luogoNascita;
    }
    public function getLuogoNascita(): string {
        return $this->luogoNascita;
    }
    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }
    public function getTelefono(): string {
        return $this->telefono;
    }
    public function setBiografia(string $biografia): void {
        $this->biografia = $biografia;
    }
    public function getBiografia(): string {
        return $this->biografia;
    }
    // Metodi per le letture
    public function addLettura(ELettura $lettura): void {
        $this->letture[] = $lettura;
    }
    public function getLetture(): array {
        return $this->letture;
    }
    public function removeLettura(ELettura $lettura): void {
        foreach ($this->letture as $key => $value) {
            if ($value->getCodice() === $lettura->getCodice()) {
                unset($this->letture[$key]);
            }
        }
    }
    public function getLetturaById( int $id): ?ELettura {
        foreach ($this->letture as $lettura) {
            if ($lettura->getCodice() === $id) {
                return $lettura;
            }
        }
        return null;
    }
    public function getLetturaCount(): int {
        return count($this->letture);
    }

    // Metodi per le PlotCard
    public function addPlotCard(EPlotCard $plotCard): void {
        $this->PlotCard[0] = $plotCard;
    }
    public function getPlotCard(): EPlotCard {
        return $this->PlotCard[0];
    }
    public function removePlotCard(): void {
        array_shift($this->PlotCard);
    }
}

?>