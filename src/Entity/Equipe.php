<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
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

    private $nomEquipe;

    /**
     * @ORM\Column(type="date")
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $Logo;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $League;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank
     */

    private $Pays;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank
     */

    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank
     */

    private $SiteWeb;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank
     *  @Assert\Url(
     *    relativeProtocol = true)
     */
    private $Palmares;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipe(): ?string
    {
        return $this->nomEquipe;
    }

    public function setNomEquipe(string $nomEquipe): self
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->Logo;
    }

    public function setLogo(string $Logo): self
    {
        $this->Logo = $Logo;

        return $this;
    }

    public function getLeague(): ?string
    {
        return $this->League;
    }

    public function setLeague(string $League): self
    {
        $this->League = $League;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->SiteWeb;
    }

    public function setSiteWeb(string $SiteWeb): self
    {
        $this->SiteWeb = $SiteWeb;

        return $this;
    }

    public function getPalmares(): ?string
    {
        return $this->Palmares;
    }

    public function setPalmares(string $Palmares): self
    {
        $this->Palmares = $Palmares;

        return $this;
    }
}
