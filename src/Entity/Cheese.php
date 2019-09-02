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
    private $area;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $frenchWikipedia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $englishWikiPedia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $milk;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $geoShape = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $geoPoint = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFrenchWikipedia(): ?string
    {
        return $this->frenchWikipedia;
    }

    public function setFrenchWikipedia(?string $frenchWikipedia): self
    {
        $this->frenchWikipedia = $frenchWikipedia;

        return $this;
    }

    public function getEnglishWikiPedia(): ?string
    {
        return $this->englishWikiPedia;
    }

    public function setEnglishWikiPedia(?string $englishWikiPedia): self
    {
        $this->englishWikiPedia = $englishWikiPedia;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getMilk(): ?string
    {
        return $this->milk;
    }

    public function setMilk(?string $milk): self
    {
        $this->milk = $milk;

        return $this;
    }

    public function getGeoShape(): ?array
    {
        return $this->geoShape;
    }

    public function setGeoShape(?array $geoShape): self
    {
        $this->geoShape = $geoShape;

        return $this;
    }

    public function getGeoPoint(): ?array
    {
        return $this->geoPoint;
    }

    public function setGeoPoint(?array $geoPoint): self
    {
        $this->geoPoint = $geoPoint;

        return $this;
    }
}
