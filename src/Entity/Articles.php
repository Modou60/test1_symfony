<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @Assert/NotBlank
     */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 40,
     * minMessage = "Le titre doit avoir au minimum {{ limit }} characters",
     * maxMessage = "le titre ne doit pas dépasser {{ limit }} characters")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     * min = 5,
     * max = 100,
     * minMessage = "Le contenu doit avoir minimum {{ limit }} caractères",
     * maxMessage = "Le contenu doit avoir au maximum {{ limit }} characters")
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @ORM\Column(type="text")
     * @Assert\Length(
     * min = 6,
     * max = 100,
     * minMessage = "Le résumé doit avoir minimum {{ limit }} characters",
     * maxMessage = "Le résumé doit avoir au maximum {{ limit }} characters")
     */
    private $resume;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Auteurs::class, mappedBy="article")
     */
    private $auteur;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
    }
	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }







    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Auteurs[]
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Auteurs $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur[] = $auteur;
            $auteur->addArticle($this);
        }

        return $this;
    }

    public function removeAuteur(Auteurs $auteur): self
    {
        if ($this->auteur->removeElement($auteur)) {
            $auteur->removeArticle($this);
        }

        return $this;
    }

}
