<?php
namespace Entity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Data")
 */
class EData{
    /** 
     * @ORM\id
     * @ORM\GeneratedValue(strategy="IDENTITY")             
     * @ORM\Column(name="id_data", type="integer") 
     */
    private int $id = 0;
    /**            
     * @ORM\Column(type="string") 
     */
    private string $giorno;
    /**            
     * @ORM\Column(type="string") 
     */
    private string $mese;
    /**            
     * @ORM\Column(type="string") 
     */
    private string $anno;
    
    public function __construct(string $giorno, string $mese, string $anno) {
        $this->setGiorno($giorno);
        $this->setMese($mese);
        $this->setAnno($anno);
    }
    //Metodi set e get
    public function setGiorno(string $giorno) {
        $this->giorno = $giorno;
    }
    public function getId(): int {
        return $this->id;
    }
    public function getGiorno(): string {
        return $this->giorno;
    }
    public function setMese(string $mese) {
        $this->mese = $mese;
    }   
    public function getMese(): string {
        return $this->mese;
    }
    public function setAnno(string $anno) {
        $this->anno = $anno;
    }
    public function getAnno(): string {
        return $this->anno;
    }
    public function getData(): string {
        return $this->giorno . "/" . $this->mese . "/" . $this->anno;
    }
    public function setData(string $data): void {
        $parts = explode("/", $data);
        if (count($parts) == 3) {
            $this->setGiorno($parts[0]);
            $this->setMese($parts[1]);
            $this->setAnno($parts[2]);
        }
    }

}

?>