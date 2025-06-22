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

    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "reviews", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: "fk_subscriber", referencedColumnName: "user_id", onDelete: "cascade")] // definizione chiave esterna
    private EUser $subscriber;
    #[ORM\ManyToOne(targetEntity: "EArticle", inversedBy: "reviews", cascade: ["persist","remove"])]
    #[ORM\JoinColumn(name: "fk_article", referencedColumnName: "article_id", onDelete: "cascade")] // definizione chiave esterna
    private EArticle $article;

    public function __construct(int $evaluate, string $comment, string $releaseDate, EUser $subscriber , EArticle $article ) {

        $this->evaluate = $evaluate;
        $this->comment = $comment;
        $this->subscriber = $subscriber;
        $this->article = $article;
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
    public function setSubscriber(EUser $subscriber) {
        $this->subscriber = $subscriber;
    }
    public function getSubscriber(): EUser {
        return $this->subscriber;
    }
    public function setArticle(EArticle $article) {
        $this->article = $article;
    }
    public function getArticle(): EArticle {
        return $this->article;
    }

    public function getReleaseDate(): DateTime {
        return $this->releaseDate;
    }
    public function setReleaseDate(string $releaseDate) {
        $this->releaseDate = new DateTime($releaseDate);
    }
}


?>