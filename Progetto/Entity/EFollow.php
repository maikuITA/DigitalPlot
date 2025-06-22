<?php

use Doctrine\ORM\Mapping as ORM;  


#[ORM\Entity]
#[ORM\Table(name: "Follow")]
class EFollow{
    
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "followers", cascade: ["persist"])]
    #[ORM\JoinColumn(name: "fk_follower", referencedColumnName: "user_id", nullable: false)] // definizione chiave esterna
    private EUser $follower;
    

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: "EUser", inversedBy: "following", cascade: ["persist"])]
    #[ORM\JoinColumn(name: "fk_following", referencedColumnName: "user_id", nullable: false)] // definizione chiave esterna
    private EUser $following;


    public function __construct(EUser $follower, EUser $following) {
        $this->follower = $follower;
        $this->following = $following;
    }

    public function getFollower(): EUser{
        return $this->follower;
    }
    public function getFollowing(): EUser{
        return $this->following;
    }
}




?>