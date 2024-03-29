<?php

namespace App\Entity;

use App\Repository\TvRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TvRepository::class)]
class Tv
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
    private $idTmdb;

    #[ORM\ManyToOne(targetEntity: Statue::class, inversedBy: 'tv')]
    private $statue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(
        max: 255
    )]
    private $country;

    #[ORM\Column(type: 'boolean')]
    private $anime;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\NotBlank]
    private $media;

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

    public function getIdTmdb(): ?int
    {
        return $this->idTmdb;
    }

    public function setIdTmdb(int $idTmdb): self
    {
        $this->idTmdb = $idTmdb;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getAnime(): ?bool
    {
        return $this->anime;
    }

    public function setAnime(bool $anime): self
    {
        $this->anime = $anime;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }
}
