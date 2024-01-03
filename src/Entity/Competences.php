<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Competence = null;

    #[ORM\ManyToOne(targetEntity: CategoriesCompetence::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $categorie;
  
     
     #[ORM\ManyToMany(targetEntity:User::class)] 
     
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetence(): ?string
    {
        return $this->Competence;
    }

    public function setCompetence(string $Competence): self
    {
        $this->Competence = $Competence;

        return $this;
    }

    public function getCategorie(): ?CategoriesCompetence
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriesCompetence $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
    
    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

}
