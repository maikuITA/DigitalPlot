<?php

use Doctrine\ORM\Mapping as ORM;



/*dato che l'ereditarietà non viene gestita da Doctrine in maniera automatica specifichiamo il risultato della ereditarietà tramite la seconda dicitura. Con table per class 
la classe Lettore e Abbonato rappresentano due tabelle distinte e in Lettore compaiono gli stessi campi di Abbonato pù quelli propri
*/

#[ORM\Entity]
#[ORM\Table(name: "Lettore")]
class ELettore extends EAbbonato{
    
    public function __construct(string $username, string $password, string $nome, string $cognome, string $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "", $followers = [], $following = []) {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia, $followers, $following);
        

    }
}