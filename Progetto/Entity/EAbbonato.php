<?php

use Doctrine\ORM\Mapping as ORM;

namespace Entity;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("TABLE_PER_CLASS")
 * @ORM\Table(name="Abbonati")
 */

class EAbbonato extends EUser{
    // consigliato rispetto al tipo array, serializzazione tramite json e non php
    /**  
     * @ORM\Column(type="json") 
    */
    private $followers = [];
    /**  
     * @ORM\Column(type="json") 
    */
    private $following = [];
    
    public function __construct(string $username, string $password, string $nome, string $cognome, EData $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "", $followers = [], $following = []) {
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


}