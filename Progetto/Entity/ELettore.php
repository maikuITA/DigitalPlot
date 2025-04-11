<?php

namespace Entity;

class ELettore extends EAbbonato{
    
    public function __construct(string $username, string $password, string $nome, string $cognome, EData $dataNascita, string $luogoNascita, string $email, string $telefono, EPlotCard $plotCard, string $biografia = "", $followers = [], $following = []) {
        parent::__construct($username, $password, $nome, $cognome, $dataNascita, $luogoNascita, $email, $telefono, $plotCard, $biografia, $followers, $following);
        

    }
}