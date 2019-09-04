<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExchangeRepository")
 */
class Exchange
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateValidated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCompleted;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ad", cascade={"persist", "remove"})
     */
    private $ad;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cheese", inversedBy="exchanges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cheeseGiven;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="createdExchanges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateProposed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateValidated(): ?\DateTimeInterface
    {
        return $this->dateValidated;
    }

    public function setDateValidated(\DateTimeInterface $dateValidated): self
    {
        $this->dateValidated = $dateValidated;

        return $this;
    }

    public function getDateCompleted(): ?\DateTimeInterface
    {
        return $this->dateCompleted;
    }

    public function setDateCompleted(?\DateTimeInterface $dateCompleted): self
    {
        $this->dateCompleted = $dateCompleted;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCheeseGiven(): ?Cheese
    {
        return $this->cheeseGiven;
    }

    public function setCheeseGiven(?Cheese $cheeseGiven): self
    {
        $this->cheeseGiven = $cheeseGiven;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getDateProposed(): ?\DateTimeInterface
    {
        return $this->dateProposed;
    }

    public function setDateProposed(\DateTimeInterface $dateProposed): self
    {
        $this->dateProposed = $dateProposed;

        return $this;
    }
}
