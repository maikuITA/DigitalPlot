<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Review")]
class EReview{

    #[ORM\Id]        
    #[ORM\GeneratedValue(strategy: "IDENTITY")]  
    #[ORM\Column(name: "review_cod", type: "integer")] 
    private int $cod;
    #[ORM\Column(type: "integer")] 
    private int $evaluate;
    #[ORM\Column(type: "string", length: 100)] 
    private string $comment;

    #[ORM\Column(name: "release_date", type: "date")]
    private DateTime $releaseDate;

    #[ORM\ManyToOne(targetEntity: "ESubscriber", inversedBy: "reviews")]
    #[ORM\JoinColumn(name: "fk_subscriber", referencedColumnName: "user_id", nullable: false)] // definizione chiave esterna
    private ESubscriber $subscriberId;
    #[ORM\ManyToOne(targetEntity: "EArticle", inversedBy: "reviews")]
    #[ORM\JoinColumn(name: "fk_article", referencedColumnName: "article_id", nullable: false)] // definizione chiave esterna
    private EArticle $articleId;

    public function __construct(int $evaluate, string $comment, string $releaseDate, ESubscriber $subscriberId , EArticle $articleId ) {

        $this->evaluate = $evaluate;
        $this->comment = $comment;
        $this->subscriberId = $subscriberId;
        $this->articleId = $articleId;
        $this->releaseDate = new DateTime($releaseDate);
    }

    //Metodi set e get
    public function setCod(int $cod) {
        $this->cod = $cod;
    }
    public function getCod(): int {
        return $this->cod;
    }
    public function setEvaluate(int $evaluate) {
        $this->evaluate = $evaluate;
    }
    public function getEvaluate(): int {
        return $this->evaluate;
    }
    public function setComment(string $comment) {
        $this->comment = $comment;
    }
    public function getComment(): string {
        return $this->comment;
    }
    public function setUserId(ESubscriber $subscriberId) {
        $this->subscriberId = $subscriberId;
    }
    public function getSubscriberId(): ESubscriber {
        return $this->subscriberId;
    }
    public function setArticle(EArticle $articleId) {
        $this->articleId = $articleId;
    }
    public function getArticleId(): EArticle {
        return $this->articleId;
    }

    public function getReleaseDate(): DateTime {
        return $this->releaseDate;
    }
    public function setReleaseDate(string $releaseDate) {
        $this->releaseDate = new DateTime($releaseDate);
    }
}


?>