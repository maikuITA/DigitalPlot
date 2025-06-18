<?php


use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "Subscriber")]
class ESubscriber extends EUser{
    // consigliato rispetto al tipo array, serializzazione tramite json e non php
    
    // definisco il name del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "follower", cascade: ["persist", "remove"])]
    private $followers = [];
    
    #[ORM\OneToMany(targetEntity: "EFollow", mappedBy: "following", cascade: ["persist", "remove"])]
    private $following = [];

    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "subscriber", cascade: ["persist", "remove"])]
    private $reviews = [];
    
    public function __construct(string $username, string $password, string $name, string $surname, string $birthdate, string $birthplace, string $email, string $telephone, EPlotCard $plotCard, string $biography = "", $followers = [], $following = []) {
        parent::__construct($username, $password, $name, $surname, $birthdate, $birthplace, $email, $telephone, $plotCard, $biography);
        $this->followers = $followers;
        $this->following = $following;

    }

    // followers

    public function setFollowers(ESubscriber $follower): void{
        array_push($this->followers, $follower);
    }
    public function getFollowers(): array{
        return $this->followers;
    }
    public function getFollower(int $index): ESubscriber{
        return $this->followers[$index];
    }
    public function getNumFollowers(): int{
        return count($this->followers);
    }
    public function removeFollower(ESubscriber $follower): void{
        foreach($this->followers as $key => $value){
            if($value == $follower){
                unset($this->followers[$key]);
            }
        }
    }
    public function getFollowerById(int $id): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getId() == $id){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByUsername(string $username): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getUsername() == $username){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByEmail(string $email): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getEmail() == $email){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByName(string $name): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getName() == $name){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerBySurname(string $surname): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getSurname() == $surname){
                return $follower;
            }
        }
        return null;
    }
    public function getFollowerByBirthdate(string $birthdate): ?ESubscriber{
        foreach($this->followers as $follower){
            if($follower->getBirthdate() == $birthdate){
                return $follower;
            }
        }
        return null;
    }

    // following

    public function addFollowing(ESubscriber $following): void{
        array_push($this->following, $following);
    }
    public function getFollowing(): array{
        return $this->following;
    }

    public function getNumFollowing(): int{
        return count($this->following);
    }

    // gestione reviews
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

}