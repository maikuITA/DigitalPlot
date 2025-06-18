<?php

use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: "Reading")]

class EReading{
    #[ORM\Id]           
    #[ORM\GeneratedValue(strategy:"IDENTITY")]  
    #[ORM\Column(name:"reading_cod", type:"integer")]
    private int $cod;
    #[ORM\ManyToOne(targetEntity:"EUser", inversedBy: "readings")]
    #[ORM\JoinColumn(name : "fk_user" , referencedColumnName : "user_id", nullable:false)] // definizione chiave esterna
    private EUser $userId;
    #[ORM\ManyToOne(targetEntity: "EArticle", inversedBy: "readings")]
    #[ORM\JoinColumn(name : "fk_article", referencedColumnName : "article_id", nullable: false)] // definizione chiave esterna
    private EArticle $articleId;

    public function __construct(EUser $userId, EArticle $articleId ) {
        $this->userId = $userId;
        $this->articleId = $articleId;
    }

    // Set methods
    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }
    public function setUserId(EUser $userId)
    {
        $this->userId = $userId;
    }
    public function setArticleId(EArticle $articleId)
    {
        $this->articleId = $articleId;
    }
    // Get methods
    public function getCod(){
        return $this->cod;
    }
    public function getUserId(): EUser{
        return $this->userId;
    }
    public function getArticleId(): EArticle{
        return $this->articleId;
    }
}