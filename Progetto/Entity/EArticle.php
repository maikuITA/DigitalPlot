<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Article")]
class EArticle{

    #[ORM\Id]   
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "article_id", type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "string", length: 100)]
    private string $title;
    
    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(name: "state", type: "string", length: 100)]
    private string $state;

    #[ORM\Column(name: "category", type: "string", length: 100)]
    private string $category;
    
    #[ORM\Column(name: "genre", type: "string", length: 100)]
    private string $genre;

    #[ORM\Column(type: "blob", nullable: true)]
    private $contents;
    
    #[ORM\Column(name:"release_date",type: "date")]
    private DateTime $releaseDate;
    
    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "articleId", cascade: ["persist", "remove"])]
    private Collection $reviews;
    
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "articles", cascade: ["persist"])]
    #[ORM\JoinColumn(name: "fk_writer", referencedColumnName: "user_id", onDelete: "cascade")] // definizione chiave esterna
    private EUser $writer;
    
    #[ORM\OneToMany(targetEntity: "EReading", mappedBy: "articleId", cascade: ["persist", "remove"])]
    private Collection $readings;

    public function __construct(string $title,string $description, mixed $contents ,string $state = PENDING, string $genre, string $category, string $releaseDate, EUser $writer) {
        $this->title = $title;
        $this->description = $description;
        $this->contents = $contents;
        $this->state = $state;
        $this->genre = $genre;
        $this->category = $category;
        $this->releaseDate = new DateTime($releaseDate);
        $this->readings = new ArrayCollection();
        $this->writer = $writer;
        $this->reviews = new ArrayCollection();
    }

    //Metodi set e get
    public function getAvgEvaluate(): float {
        $sum = 0;
        $count = 0;
        foreach ($this->reviews as $review) {
            $sum += $review->getEvaluate();
            $count++;
        }
        return $count > 0 ? number_format(($sum / $count), 2) : 0;
    }


    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setGenre(string $genre) {
        $this->genre = $genre;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function setCategory(string $category) {
        $this->category = $category;
    }

    public function getCategory(): string {
        return $this->category;
    }
    public function setWriter(EUser $writer) {
        $this->writer = $writer;
    }
    public function getWriter(): EUser {
        return $this->writer;
    }
    public function setReleaseDate(string $releaseDate){
        $this->releaseDate = new DateTime($releaseDate);
    }
    public function getReleaseDate(): DateTime{
        return $this->releaseDate;
    }
    public function setState(string $state) {
        $this->state = $state;
    }
    public function getState(): string {
        return $this->state;
    }
    public function setContents(string $contents): void {
        $this->contents = $contents;
    }
    public function getContent() {
        return $this->contents;
    }
    public function getHtmlContent(): ?string {
        if ($this->contents === null) {
            return null;
        }
        if (is_resource($this->contents)) {
            return stream_get_contents($this->contents);
        }

        return $this->contents;
    }


    //Gestione delle reviews
    public function addReview(EReview $review): void {
        $this->reviews->add($review);
    }
    public function getReviews() {
        return $this->reviews;
    }
    public function removeReview(EReview $review): void {
        if($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
        }
    }
    public function countReviews(): int {
        return $this->reviews->count();
    }
    public function getReviewsById(int $index){
        foreach ($this->reviews as $review) {
            if ($review->getCod() === $index) {
                return $review;
            }
        }
        return null; 
    }

    //Gestione delle readings
    public function addReading(EReading $reading): void {
        $this->readings->add($reading);
    }
    public function getReadings() {
        return $this->readings;
    }
    public function removeReading(EReading $reading): void {
        if($this->readings->contains($reading)) {
            $this->readings->removeElement($reading);
        }
    }
    public function countReadings(): int {
        return $this->readings->count();
    }
    public function getReadingById(int $index) {
        foreach ($this->readings as $reading) {
            if ($reading->getCod() === $index) {
                return $reading;
            }
        }
        return null;
     } 
}
?>