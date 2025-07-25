<?php

use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: "Reading")]

class EReading{
    #[ORM\Id]           
    #[ORM\GeneratedValue(strategy:"IDENTITY")]  
    #[ORM\Column(name:"reading_cod", type:"integer")]
    private int $cod;

    #[ORM\ManyToOne(targetEntity:"EUser", inversedBy: "readings", cascade: ["persist"])]
    #[ORM\JoinColumn(name : "fk_user" , referencedColumnName : "user_id", nullable:false, onDelete: "cascade")] // definizione chiave esterna
    private EUser $user;

    #[ORM\ManyToOne(targetEntity: "EArticle", inversedBy: "readings", cascade: ["persist"])]
    #[ORM\JoinColumn(name : "fk_article", referencedColumnName : "article_id", nullable: false, onDelete: "cascade")] // definizione chiave esterna
    private EArticle $articleId;

    public function __construct(EUser $user, EArticle $articleId ) {
        $this->user = $user;
        $this->articleId = $articleId;
    }

    // Set methods
    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }
    public function setUser(EUser $user)
    {
        $this->user = $user;
    }
    public function setArticle(EArticle $article)
    {
        $this->articleId = $article;
    }
    // Get methods
    public function getCod(){
        return $this->cod;
    }
    public function getUser(): EUser{
        return $this->user;
    }
    public function getArticle(): EArticle{
        return $this->articleId;
    }
}