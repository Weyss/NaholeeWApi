<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Length(
        max: 255
    )]
    private $title;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private $idFilmTmdb;

    #[ORM\ManyToOne(targetEntity: Statue::class, inversedBy: 'film')]
    private $statue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIdFilmTmdb(): ?int
    {
        return $this->idFilmTmdb;
    }

    public function setIdFilmTmdb(int $idFilmTmdb): self
    {
        $this->idFilmTmdb = $idFilmTmdb;

        return $this;
    }

    public function getStatue(): ?Statue
    {
        return $this->statue;
    }

    public function setStatue(?Statue $statue): self
    {
        $this->statue = $statue;

        return $this;
    }
}
