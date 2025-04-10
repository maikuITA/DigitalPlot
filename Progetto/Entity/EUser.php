<?php 

namespace Entity;

class EUser {
    private ?int $id = null;
    private string $username;
    private string $password;
    private bool $status = true;

    private string $nome;
    private string $cognome;
    private EData $dataNascita;
    private string $luogoNascita;                                           
    private string $email;  
    private string $telefono;
    private EPlotCard $plotCard;

    private string $biografia;


    public function __construct(string $username, string $password, string $nome, string $cognome, EData $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "") {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setNome($nome);
        $this->setCognome($cognome);
        $this->setDataNascita($dataNascita);
        $this->setLuogoNascita($luogoNascita);
        $this->setEmail($email);
        $this->setTelefono($telefono);
        $this->setPlotCard($plotCard);
        $this->setBiografia($biografia);
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
    public function setDataNascita(EData $dataNascita): void {
        $this->dataNascita = $dataNascita;
    }
    public function getDataNascita(): EData {
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
    public function setPlotCard(EPlotCard $plotCard): void {
        $this->plotCard = $plotCard;
    }
    public function getPlotCard(): EPlotCard {
        return $this->plotCard;
    }
    public function setBiografia(string $biografia): void {
        $this->biografia = $biografia;
    }
    public function getBiografia(): string {
        return $this->biografia;
    }
}
?>