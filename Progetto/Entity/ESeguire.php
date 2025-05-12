<?php

use Doctrine\ORM\Mapping as ORM;  


#[ORM\Entity]
#[ORM\Table(name: "Seguire")]
class ESeguire{
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "EAbbonato", inversedBy: "followers")]
    #[ORM\JoinColumn(name: "fk_follower", referencedColumnName: "id_utente", nullable: false)] // definizione chiave esterna
    private $follower;
    

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "EAbbonato", inversedBy: "following")]
    #[ORM\JoinColumn(name: "fk_following", referencedColumnName: "id_utente", nullable: false)] // definizione chiave esterna
    private $following;


    public function __construct(EAbbonato $follower, EAbbonato $following) {
        $this->follower = $follower;
        $this->following = $following;
    }

    public function getFollower(): EAbbonato{
        return $this->follower;
    }
    public function getFollowing(): EAbbonato{
        return $this->following;
    }
}




?>