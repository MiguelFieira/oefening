<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToernooiRepository")
 */
class Toernooi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aanmelding", mappedBy="toernooi", orphanRemoval=true)
     */
    private $toernooien;

    public function __construct()
    {
        $this->toernooien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(?\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }
    public function __toString() {
        return ''.$this->omschrijving;
    }

    /**
     * @return Collection|Aanmelding[]
     */
    public function getToernooien(): Collection
    {
        return $this->toernooien;
    }

    public function addToernooien(Aanmelding $toernooien): self
    {
        if (!$this->toernooien->contains($toernooien)) {
            $this->toernooien[] = $toernooien;
            $toernooien->setToernooi($this);
        }

        return $this;
    }

    public function removeToernooien(Aanmelding $toernooien): self
    {
        if ($this->toernooien->contains($toernooien)) {
            $this->toernooien->removeElement($toernooien);
            // set the owning side to null (unless already changed)
            if ($toernooien->getToernooi() === $this) {
                $toernooien->setToernooi(null);
            }
        }

        return $this;
    }
}
