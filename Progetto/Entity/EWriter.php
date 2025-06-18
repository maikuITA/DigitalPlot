<?php


use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "Writer")]
class EWriter extends ESubscriber {
    
    
    #[ORM\Column(type: "integer")]
    private int $numFollowers = 0;
    
    #[ORM\Column(type: "integer")]
    private int $numFollowing = 0;
   
    #[ORM\Column(type: "integer")]
    private int $numeroArticles;
    
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    #[ORM\OneToMany(targetEntity: "EArticle", mappedBy: "idWriter", cascade: ["persist", "remove"])]
    private $articles = [];
    
    #[ORM\Column(type: "float")]
    private float $evaluation;

    public function __construct(string $username, string $password, string $name, string $surname, string $birthdate, string $birthplace, string $email, string $telephone, EPlotCard $plotCard, string $biography = "", $followers = [], $following = [], $articles = []) {
        parent::__construct($username, $password, $name, $surname, $birthdate, $birthplace, $email, $telephone, $plotCard, $biography, $followers, $following);
        $this->numFollowers = count($followers);
        $this->numFollowing = count($following);
        $this->numeroArticles = count($articles);
        $this->articles = $articles;
        $this->evaluation = $this->updateEvaluation($articles);
    }

    public function addArticle(EArticle $article): void{
        array_push($this->articles, $article);
    }
    public function getArticles(): array{
        return $this->articles;
    }
    public function getArticle(int $index): EArticle{
        return $this->articles[$index];
    }
    public function getNumArticles(): int{
        $numeroArticles = count($this->articles);
        return $numeroArticles;
    }
    public function updateFollowers(): void{
        $this->numFollowers = parent::getNumFollowers();
    }
    public function updateFollowing(): void{
        $this->numFollowing = parent::getNumFollowing();
    }
    public function updateEvaluation(array $articles): float{
        $media = 0;
        foreach($articles as $article){
            $media = $media + $article->getMediaEvaluation();
        }
        $evaluation = $media / count($articles);
        return $evaluation;
    }
    public function getEvaluation(): float{
        return $this->evaluation;
    }
    public function setEvaluation(float $evaluation): void{
        $this->evaluation = $evaluation;
    }
    public function getNumFollowers(): int{
        return $this->numFollowers;
    }
    public function setNumFollowers(int $numFollowers): void{
        $this->numFollowers = $numFollowers;
    }
    public function getNumFollowing(): int{
        return $this->numFollowing;
    }
    public function setNumFollowing(int $numFollowing): void{
        $this->numFollowing = $numFollowing;
    }
    public function getNumeroArticles(): int{
        return $this->numeroArticles;
    }
}



