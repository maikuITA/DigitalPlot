<?php

namespace Entity;

class ELettore extends EAbbonato{
    private int $numFollowing = 0;
    
    public function __construct(int $id, string $username, string $password, string $email, string $nome, string $cognome, string $dataNascita) {
        parent::__construct($id, $username, $password, $email, $nome, $cognome, $dataNascita);
    }

    public function setNumFollowing(int $numFollowing): void{
        $this->numFollowing = $numFollowing;
    }
    public function getNumFollowing(): int{
        return $this->numFollowing;
    }
}