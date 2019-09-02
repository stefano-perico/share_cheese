<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CheeseRepository")
 */
class Cheese
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkAPI;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkAPI(): ?string
    {
        return $this->linkAPI;
    }

    public function setLinkAPI(string $linkAPI): self
    {
        $this->linkAPI = $linkAPI;

        return $this;
    }
}
