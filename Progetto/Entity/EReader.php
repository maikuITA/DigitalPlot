<?php

use Doctrine\ORM\Mapping as ORM;



/*dato che l'ereditarietà non viene gestita da Doctrine in maniera automatica specifichiamo il risultato della ereditarietà tramite la seconda dicitura. Con table per class 
la classe Lettore e Subscriber rappresentano due tabelle distinte e in Lettore compaiono gli stessi campi di Subscriber pù quelli propri
*/

#[ORM\Entity]
#[ORM\Table(name: "Reader")]
class EReader extends ESubscriber{
    
    public function __construct(string $username, string $password, string $name, string $surname, string $birthdate, string $birthplace, string $email, string $telephone, string $biography = "", $plotCard, $followers = [], $following = []) {
        parent::__construct($username, $password, $name, $surname, $birthdate, $birthplace, $email, $telephone, $biography, $plotCard, $followers, $following);
    }
}