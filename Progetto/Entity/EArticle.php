<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Article")]
class EArticle{

    #[ORM\Id]   
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "article_id", type: "integer")]
    private int $id;
    
    #[ORM\Column(type: "string", length: 100)]
    private string $title = "";
    
    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(name: "state", type: "string", length: 100)]
    private string $state;
    
    #[ORM\Column(name: "genre", type: "string", length: 100)]
    private string $genre;
    
    #[ORM\Column(name: "category", type: "string", length: 100)]
    private string $category;
    
    #[ORM\Column(name:"release_date",type: "date")]
    private DateTime $releaseDate;
    
    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "idArticle", cascade: ["persist", "remove"])]
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private $reviews = [];
    
    #[ORM\ManyToOne(targetEntity: "EWriter", inversedBy: "articles")]
    #[ORM\JoinColumn(name: "fk_writer", referencedColumnName: "user_id", nullable: false)] // definizione chiave esterna
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private EWriter $idWriter;
    
    #[ORM\OneToMany(targetEntity: "EReading", mappedBy: "articles", cascade: ["persist", "remove"])]
    private $readings = [];


    public function __construct(string $title,string $description,string $state = "da approvare", string $genre, string $category, string $releaseDate, EWriter $idWriter, array $readings = [], array $reviews = []) {
        $this->title = $title;
        $this->description = $description;
        $this->state = $state;
        $this->genre = $genre;
        $this->category = $category;
        $this->releaseDate = new DateTime($releaseDate);
        $this->readings = $readings;
        $this->idWriter = $idWriter;
        $this->reviews = $reviews;
    }

    //Metodi set e get
    
    public function getMediaValutazione(): float {
        $somma = 0;
        $count = 0;
        foreach ($this->reviews as $review) {
            $somma += $review->getValutazione();
            $count++;
        }
        return $count > 0 ? $somma / $count : 0;
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
    public function setIdWriter(EWriter $idWriter) {
        $this->idWriter = $idWriter;
    }
    public function getIdWriter(): EWriter {
        return $this->idWriter;
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

    //Gestione delle reviews

    public function addReview(EReview $review): void {
        array_push($this->reviews, $review);
    }
    public function getReviews(): array {
        return $this->reviews;
    }
    public function getReviewById(int $id): ?EReview {
        foreach ($this->reviews as $review) {
            if ($review->getId() === $id) {
                return $review;
            }
        }
        return null;
    }
    public function removeReview(int $id): void {
        foreach ($this->reviews as $key => $review) {
            if ($review->getId() === $id) {
                unset($this->reviews[$key]);
                break;
            }
        }
    }
    public function getReviewCount(): int {
        return count($this->reviews);
    }
    //Gestione delle readings
    public function addReading(EReading $reading): void {
        array_push($this->readings, $reading);
    }
    public function getReadings(): array {
        return $this->readings;
    }
    public function getReadingById(int $id): ?EReading {
        foreach ($this->readings as $reading) {
            if ($reading->getId() === $id) {
                return $reading;
            }
        }
        return null;
    }
    public function removeReading(int $id): void {
        foreach ($this->readings as $key => $reading) {
            if ($reading->getId() === $id) {
                unset($this->readings[$key]);
                break;
            }
        }
    }
    public function getReadingCount(): int {
        return count($this->readings);
    }
}
?>