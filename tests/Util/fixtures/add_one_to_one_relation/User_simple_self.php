<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="user", cascade={"persist", "remove"})
     */
    private $embeddedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmbeddedUser(): ?self
    {
        return $this->embeddedUser;
    }

    public function setEmbeddedUser(?self $embeddedUser)
    {
        $this->embeddedUser = $embeddedUser;

        // set (or unset) the inverse side of the relation if necessary
        $newUser = $embeddedUser === null ? null : $this;
        if ($newUser !== $embeddedUser->getUser()) {
            $embeddedUser->setUser($newUser);
        }
    }

    // add your own fields
}
