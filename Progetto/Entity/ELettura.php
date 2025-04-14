<?php
namespace Entity;  
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="Lettura")
 */
class ELettura{
    /** 
     * @ORM\id            
     * @ORM\GeneratedValue(strategy="IDENTITY")  
     * @ORM\Column(name="id_lettura", type="integer") 
     */
    private int $codice;
    /** 
     * @ORM\ManyToOne(targetEntity="Utente", inversedBy= "letture")
     * @ORM\JoinColumn(name = "fk_utente, referencedColumnName = "id_utente", nullable=false) // definizione chiave esterna
    */
    private int $idUser;
    /** 
     * @ORM\OneToMany(targetEntity="Articolo", mappedBy="letture", cascade={"persist", "remove"})  // definisco il nome del campo dell'altra tabella che è chiave esterna
    */
    private int $idArticolo;

    public function __construct(int $codice) {
        $this->codice = $codice;
    }

    // Set methods
    public function setCodice(int $codice)
    {
        $this->codice = $codice;
    }
    // Get methods
    public function getCodice(){
        return $this->codice;
    }
}