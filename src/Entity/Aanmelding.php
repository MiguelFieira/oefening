<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AanmeldingRepository")
 */
class Aanmelding
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spelers", inversedBy="aanmeldingen")
     * @ORM\JoinColumn(nullable=false)
     */
    private $speler;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Toernooi", inversedBy="toernooien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $toernooi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeler(): ?Spelers
    {
        return $this->speler;
    }

    public function setSpeler(?Spelers $speler): self
    {
        $this->speler = $speler;

        return $this;
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
}
