<?php
class EUtente
{
    private $id;
    private $nome;
    private $cognome;
    private $email;
    private $password;
    private $telefono;
    private $dataRegistrazione;

    public function __construct($id, $nome, $cognome, $email, $password, $telefono, $dataRegistrazione)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->telefono = $telefono;
        $this->dataRegistrazione = new DateTime($dataRegistrazione);
    }

    // Getters and Setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCognome()
    {
        return $this->cognome;
    }
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
    public function getDataRegistrazione()
    {
        return $this->dataRegistrazione;
    }
    public function setDataRegistrazione($dataRegistrazione)
    {
        $this->dataRegistrazione = new DateTime($dataRegistrazione);
    }
    public function __toString()
    {
        return "ID: $this->id, Nome: $this->nome, Cognome: $this->cognome, Email: $this->email, Telefono: $this->telefono, Data Registrazione: " . $this->dataRegistrazione->format('Y-m-d H:i:s');
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'email' => $this->email,
            'password' => $this->password,
            'telefono' => $this->telefono,
            'dataRegistrazione' => $this->dataRegistrazione->format('Y-m-d H:i:s')
        ];
    }

}