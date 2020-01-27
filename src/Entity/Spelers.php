<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpelersRepository")
 */
class Spelers
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
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tussenvoegsel;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $achternaam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Scholen")
     */
    private $school;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aanmelding", mappedBy="speler", orphanRemoval=true)
     */
    private $aanmeldingen;

    public function __construct()
    {
        $this->aanmeldingen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVoornaam(): ?string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getTussenvoegsel(): ?string
    {
        return $this->tussenvoegsel;
    }

    public function setTussenvoegsel(?string $tussenvoegsel): self
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getSchool(): ?Scholen
    {
        return $this->school;
    }

    public function setSchool(?Scholen $school): self
    {
        $this->school = $school;

        return $this;
    }
    public function __toString() {
        return ''.$this->voornaam;
    }

    /**
     * @return Collection|Aanmelding[]
     */
    public function getAanmeldingen(): Collection
    {
        return $this->aanmeldingen;
    }

    public function addAanmeldingen(Aanmelding $aanmeldingen): self
    {
        if (!$this->aanmeldingen->contains($aanmeldingen)) {
            $this->aanmeldingen[] = $aanmeldingen;
            $aanmeldingen->setSpeler($this);
        }

        return $this;
    }

    public function removeAanmeldingen(Aanmelding $aanmeldingen): self
    {
        if ($this->aanmeldingen->contains($aanmeldingen)) {
            $this->aanmeldingen->removeElement($aanmeldingen);
            // set the owning side to null (unless already changed)
            if ($aanmeldingen->getSpeler() === $this) {
                $aanmeldingen->setSpeler(null);
            }
        }

        return $this;
    }
}
