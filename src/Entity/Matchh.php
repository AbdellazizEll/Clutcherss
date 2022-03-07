<?php

namespace App\Entity;

use App\Repository\MatchhRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MatchhRepository::class)
 */
class Matchh
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $Heure;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DatedebMatch;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $NomTournoi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->Heure;
    }

    public function setHeure(\DateTimeInterface $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getDatedebMatch(): ?\DateTimeInterface
    {
        return $this->DatedebMatch;
    }

    public function setDatedebMatch(\DateTimeInterface $DatedebMatch): self
    {
        $this->DatedebMatch = $DatedebMatch;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getNomTournoi(): ?Tournoi
    {
        return $this->NomTournoi;
    }

    public function setNomTournoi(?Tournoi $NomTournoi): self
    {
        $this->NomTournoi = $NomTournoi;

        return $this;
    }

    public function __toString(){
       
        return $this->NomTournoi;
    }

    public function _toString(){
       
        return $this->DatedebMatch;
    }
    
}
