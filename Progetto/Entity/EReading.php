<?php

use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: "Reading")]

class EReading{
    #[ORM\Id]           
    #[ORM\GeneratedValue(strategy:"IDENTITY")]  
    #[ORM\Column(name:"reading_id", type:"integer")]
    private int $cod;
    #[ORM\ManyToOne(targetEntity:"EUser", inversedBy: "readings")]
    #[ORM\JoinColumn(name : "fk_user" , referencedColumnName : "user_id", nullable:false)] // definizione chiave esterna
    private EUser $idUser;
    #[ORM\ManyToOne(targetEntity: "EArticle", inversedBy: "readings")]
    #[ORM\JoinColumn(name : "fk_article", referencedColumnName : "article_id", nullable: false)] // definizione chiave esterna
    private EArticle $idArticle;

    public function __construct(EUser $idUser, EArticle $idArticle ) {
        $this->idUser = $idUser;
        $this->idArticle = $idArticle;
    }

    // Set methods
    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }
    public function setIdUser(EUser $idUser)
    {
        $this->idUser = $idUser;
    }
    public function setIdArticle(EArticle $idArticle)
    {
        $this->idArticle = $idArticle;
    }
    // Get methods
    public function getCod(){
        return $this->cod;
    }
    public function getIdUser(): EUser{
        return $this->idUser;
    }
    public function getIdArticle(): EArticle{
        return $this->idArticle;
    }
}