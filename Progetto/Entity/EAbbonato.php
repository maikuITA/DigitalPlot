<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "Abbonato")]
class EAbbonato extends EUser{
    // consigliato rispetto al tipo array, serializzazione tramite json e non php
    
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "ESeguire", mappedBy: "follower", cascade: ["persist", "remove"])]
    private $followers = [];
    
    #[ORM\OneToMany(targetEntity: "ESeguire", mappedBy: "following", cascade: ["persist", "remove"])]
    private $following = [];

    #[ORM\OneToMany(targetEntity: "ERecensione", mappedBy: "idAbbonato", cascade: ["persist", "remove"])]
    private $recensioni = [];
    
    public function __construct(string $username, string $password, string $nome, string $cognome, string $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "", $followers = [], $following = []) {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia);
        $this->followers = $followers;
        $this->following = $following;

    }

    // followers

    public function setFollowers(EAbbonato $follower): void{
        array_push($this->followers, $follower);
    }
    public function getFollowers(): array{
        return $this->followers;
    }
    public function getFollower(int $index): EAbbonato{
        return $this->followers[$index];
    }
    public function getNumFollowers(): int{
        return count($this->followers);
    }
    public function removeFollower(EAbbonato $follower): void{
        foreach($this->followers as $key => $value){
            if($value == $follower){
                unset($this->followers[$key]);
            }
        }
    }
    public function getFollowerById(int $id): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getId() == $id){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByUsername(string $username): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getUsername() == $username){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByEmail(string $email): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getEmail() == $email){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByNome(string $nome): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getNome() == $nome){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByCognome(string $cognome): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getCognome() == $cognome){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByDataNascita(string $dataNascita): ?EAbbonato{
        foreach($this->followers as $follower){
            if($follower->getDataNascita() == $dataNascita){
                return $follower;
            }
        }
        return null;
    }

    // following

    public function addFollowing(EAbbonato $following): void{
        array_push($this->following, $following);
    }
    public function getFollowing(): array{
        return $this->following;
    }

    public function getNumFollowing(): int{
        return count($this->following);
    }

    // gestione recensioni
    public function addRecensione(ERecensione $recensione): void {
        array_push($this->recensioni, $recensione);
    }
    public function getRecensioni(): array {
        return $this->recensioni;
    }
    public function getRecensioneById(int $id): ?ERecensione {
        foreach ($this->recensioni as $recensione) {
            if ($recensione->getId() === $id) {
                return $recensione;
            }
        }
        return null;
    }
    public function removeRecensione(int $id): void {
        foreach ($this->recensioni as $key => $recensione) {
            if ($recensione->getId() === $id) {
                unset($this->recensioni[$key]);
                break;
            }
        }
    }
    public function getRecensioneCount(): int {
        return count($this->recensioni);
    }

}