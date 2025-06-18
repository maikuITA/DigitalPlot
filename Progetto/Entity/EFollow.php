<?php

use Doctrine\ORM\Mapping as ORM;  


#[ORM\Entity]
#[ORM\Table(name: "Follow")]
class EFollow{
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "ESubscriber", inversedBy: "followers")]
    #[ORM\JoinColumn(name: "fk_follower", referencedColumnName: "id_user", nullable: false)] // definizione chiave esterna
    private $follower;
    

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "ESubscriber", inversedBy: "following")]
    #[ORM\JoinColumn(name: "fk_following", referencedColumnName: "id_user", nullable: false)] // definizione chiave esterna
    private $following;


    public function __construct(ESubscriber $follower, ESubscriber $following) {
        $this->follower = $follower;
        $this->following = $following;
    }

    public function getFollower(): ESubscriber{
        return $this->follower;
    }
    public function getFollowing(): ESubscriber{
        return $this->following;
    }
}




?>