<?php 
namespace Entity;

class EProgettista extends EUser{


    public function __construct(string $username, string $password, string $nome, string $cognome, EData $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "") {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia);
    }
}
?>