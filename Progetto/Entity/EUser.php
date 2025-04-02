<?php 

namespace Entity;

class EUser {
    private ?int $id = null;
    private string $username;
    private string $password;
    private bool $status = true;

    public function __construct($id, $username, $password) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setUsername(int $username) {
        $this->username = $username;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getPassword(): string {
        return $this->password;
    }    

    public function getStatus(): bool {
        return $this->status;
    }
}

?>