<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $frenchWikipedia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $englishWikipedia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $milk;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $geoShape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geoPoint;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ad", mappedBy="cheese")
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Exchange", mappedBy="cheeseGiven")
     */
    private $exchanges;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
        $this->exchanges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
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

    public function getEnglishWikipedia(): ?string
    {
        return $this->englishWikipedia;
    }

    public function setEnglishWikiPedia(?string $englishWikipedia): self
    {
        $this->englishWikipedia = $englishWikipedia;

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

    public function getGeoShape(): ?string
    {
        return $this->geoShape;
    }

    public function setGeoShape(?string $geoShape): self
    {
        $this->geoShape = $geoShape;

        return $this;
    }

    public function getGeoPoint(): ?string
    {
        return $this->geoPoint;
    }

    public function setGeoPoint(?string $geoPoint): self
    {
        $this->geoPoint = $geoPoint;

        return $this;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setCheese($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->contains($ad)) {
            $this->ads->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getCheese() === $this) {
                $ad->setCheese(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Exchange[]
     */
    public function getExchanges(): Collection
    {
        return $this->exchanges;
    }

    public function addExchange(Exchange $exchange): self
    {
        if (!$this->exchanges->contains($exchange)) {
            $this->exchanges[] = $exchange;
            $exchange->setCheeseGiven($this);
        }

        return $this;
    }

    public function removeExchange(Exchange $exchange): self
    {
        if ($this->exchanges->contains($exchange)) {
            $this->exchanges->removeElement($exchange);
            // set the owning side to null (unless already changed)
            if ($exchange->getCheeseGiven() === $this) {
                $exchange->setCheeseGiven(null);
            }
        }

        return $this;
    }
}
