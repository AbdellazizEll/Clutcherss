<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{




    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $NomTournoi;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $NomComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomEquipe;

    /**
     * @ORM\Column(type="integer")
     */
    private $NombreJoueurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomJoueur1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomJoueur2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomJoueur3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomJoueur4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomJoueur5;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Email(
     *  message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTournoi(): ?string
    {
        return $this->NomTournoi;
    }

    public function setNomTournoi(string $NomTournoi): self
    {
        $this->NomTournoi = $NomTournoi;

        return $this;
    }

    public function getNomComplet(): ?string
    {
        return $this->NomComplet;
    }

    public function setNomComplet(string $NomComplet): self
    {
        $this->NomComplet = $NomComplet;

        return $this;
    }

    public function getNomEquipe(): ?string
    {
        return $this->NomEquipe;
    }

    public function setNomEquipe(string $NomEquipe): self
    {
        $this->NomEquipe = $NomEquipe;

        return $this;
    }

    public function getNombreJoueurs(): ?int
    {
        return $this->NombreJoueurs;
    }

    public function setNombreJoueurs(int $NombreJoueurs): self
    {
        $this->NombreJoueurs = $NombreJoueurs;

        return $this;
    }

    public function getNomJoueur1(): ?string
    {
        return $this->NomJoueur1;
    }

    public function setNomJoueur1(string $NomJoueur1): self
    {
        $this->NomJoueur1 = $NomJoueur1;

        return $this;
    }

    public function getNomJoueur2(): ?string
    {
        return $this->NomJoueur2;
    }

    public function setNomJoueur2(?string $NomJoueur2): self
    {
        $this->NomJoueur2 = $NomJoueur2;

        return $this;
    }

    public function getNomJoueur3(): ?string
    {
        return $this->NomJoueur3;
    }

    public function setNomJoueur3(?string $NomJoueur3): self
    {
        $this->NomJoueur3 = $NomJoueur3;

        return $this;
    }

    public function getNomJoueur4(): ?string
    {
        return $this->NomJoueur4;
    }

    public function setNomJoueur4(?string $NomJoueur4): self
    {
        $this->NomJoueur4 = $NomJoueur4;

        return $this;
    }

    public function getNomJoueur5(): ?string
    {
        return $this->NomJoueur5;
    }

    public function setNomJoueur5(?string $NomJoueur5): self
    {
        $this->NomJoueur5 = $NomJoueur5;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
