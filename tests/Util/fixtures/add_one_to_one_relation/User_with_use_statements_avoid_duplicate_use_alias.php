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
     * @ORM\OneToOne(targetEntity="App\OtherEntity\Category", inversedBy="user", cascade={"persist", "remove"})
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?\App\OtherEntity\Category
    {
        return $this->category;
    }

    public function setCategory(?\App\OtherEntity\Category $category)
    {
        $this->category = $category;

        // set (or unset) the inverse side of the relation if necessary
        $newUser = $category === null ? null : $this;
        if ($newUser !== $category->getUser()) {
            $category->setUser($newUser);
        }
    }

    // add your own fields
}
