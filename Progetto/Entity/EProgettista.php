<?php 

// DA VEDERE, non ha senso una tabella con una sola tupla!
use Doctrine\ORM\Mapping as ORM;

namespace Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="Progettista")
 */
class EProgettista extends EUser{


    public function __construct(string $username, string $password, string $nome, string $cognome, EData $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "") {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia);
    }
}
?>