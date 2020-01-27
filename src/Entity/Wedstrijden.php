<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WedstrijdenRepository")
 */
class Wedstrijden
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Toernooi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $toernooi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spelers")
     */
    private $speler1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\spelers")
     */
    private $speler2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spelers")
     */
    private $winaar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToernooi(): ?Toernooi
    {
        return $this->toernooi;
    }

    public function setToernooi(?Toernooi $toernooi): self
    {
        $this->toernooi = $toernooi;

        return $this;
    }

    public function getSpeler1(): ?Spelers
    {
        return $this->speler1;
    }

    public function setSpeler1(?Spelers $speler1): self
    {
        $this->speler1 = $speler1;

        return $this;
    }

    public function getSpeler2(): ?spelers
    {
        return $this->speler2;
    }

    public function setSpeler2(?spelers $speler2): self
    {
        $this->speler2 = $speler2;

        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score1;
    }

    public function setScore1(?int $score1): self
    {
        $this->score1 = $score1;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score2;
    }

    public function setScore2(?int $score2): self
    {
        $this->score2 = $score2;

        return $this;
    }

    public function getWinaar(): ?Spelers
    {
        return $this->winaar;
    }

    public function setWinaar(?Spelers $winaar): self
    {
        $this->winaar = $winaar;

        return $this;
    }
}
