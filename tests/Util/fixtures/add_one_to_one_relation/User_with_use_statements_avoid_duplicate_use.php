<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Some\Other\UserProfile;
use Some\Other\FooCategory as Category;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\OtherEntity\UserProfile", inversedBy="user", cascade={"persist", "remove"})
     */
    private $userProfile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserProfile(): ?\App\OtherEntity\UserProfile
    {
        return $this->userProfile;
    }

    public function setUserProfile(?\App\OtherEntity\UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;

        // set (or unset) the inverse side of the relation if necessary
        $newUser = $userProfile === null ? null : $this;
        if ($newUser !== $userProfile->getUser()) {
            $userProfile->setUser($newUser);
        }
    }

    // add your own fields
}
