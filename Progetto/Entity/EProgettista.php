<?php 
namespace Entity;
// DA VEDERE, non ha senso una tabella con una sola tupla!
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: "Progettista")]
class EProgettista extends EUser{


    public function __construct(string $username, string $password, string $nome, string $cognome, string $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "") {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia);
    }
}
?>