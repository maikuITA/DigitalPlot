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

    #[ORM\Column(type: "blob", nullable: true)]
    private $contents;
    
    #[ORM\Column(name:"release_date",type: "date")]
    private DateTime $releaseDate;
    
    #[ORM\OneToMany(targetEntity: "EReview", mappedBy: "articleId", cascade: ["persist", "remove"])]
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private $reviews = [];
    
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "articles", cascade: ["persist","remove"])]
    #[ORM\JoinColumn(name: "fk_writer", referencedColumnName: "user_id", nullable: false, onDelete: "cascade")] // definizione chiave esterna
    // definisco il nome del campo dell'altra tabella che è chiave esterna
    private EUser $writer;
    
    #[ORM\OneToMany(targetEntity: "EReading", mappedBy: "articleId", cascade: ["persist", "remove"])]
    private $readings = [];



    public function __construct(string $title,string $description, mixed $contents ,string $state = "da approvare", string $genre, string $category, string $releaseDate, EUser $writer, array $readings = [], array $reviews = []) {
        $this->title = $title;
        $this->description = $description;
        $this->contents = $contents;
        $this->state = $state;
        $this->genre = $genre;
        $this->category = $category;
        $this->releaseDate = new DateTime($releaseDate);
        $this->readings = $readings;
        $this->writer = $writer;
        $this->reviews = $reviews;
    }

    //Metodi set e get
    
    public function getAvgEvaluate(): float {
        $sum = 0;
        $count = 0;
        foreach ($this->reviews as $review) {
            $sum += $review->getEvaluate();
            $count++;
        }
        return $count > 0 ? $sum / $count : 0;
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
    public function getEncodedData(): ?string {
        if($this->contents === null){
            return null; // Gestione del caso in cui non sia stata impostata alcuna immagine
        }
        if(is_resource($this->contents)){
            $data = stream_get_contents($this->contents);
            return base64_encode($data);
        }else{
            return base64_encode($this->contents);
        }
        
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
    public function countReviews(): int {
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
    public function countReadings(): int {
        return count($this->readings);
    }
}
?>