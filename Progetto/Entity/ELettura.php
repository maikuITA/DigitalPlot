<?php
namespace Entity;  
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: "Lettura")]

class ELettura{
    #[ORM\Id]           
    #[ORM\GeneratedValue(strategy:"IDENTITY")]  
    #[ORM\Column(name:"id_lettura", type:"integer")]
    private int $codice;
    #[ORM\ManyToOne(targetEntity:"EUser", inversedBy: "letture")]
    #[ORM\JoinColumn(name : "fk_utente" , referencedColumnName : "id_utente", nullable:false)] // definizione chiave esterna
    private int $idUser;
    #[ORM\ManyToOne(targetEntity: "EArticolo", inversedBy: "letture")]
    #[ORM\JoinColumn(name : "fk_articolo", referencedColumnName : "id_articolo", nullable: false)] // definizione chiave esterna
    private int $idArticolo;

    public function __construct(int $idUser = 0, int $idArticolo = 0) {
        $this->idUser = $idUser;
        $this->idArticolo = $idArticolo;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;
    }
    public function setIdArticolo(int $idArticolo)
    {
        $this->idArticolo = $idArticolo;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
    public function getIdUser(){
        return $this->idUser;
    }
    public function getIdArticolo(){
        return $this->idArticolo;
    }
}