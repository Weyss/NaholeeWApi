<?php

namespace App\Entity;

use App\Repository\StatueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StatueRepository::class)]
class Statue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Assert\Regex('/\w/')]
    #[Assert\Length(
        max: 50
    )]
    private $statue;

    #[ORM\OneToMany(mappedBy: 'statue', targetEntity: Film::class)]
    private $film;

    #[ORM\OneToMany(mappedBy: 'statue', targetEntity: Movie::class)]
    private $movie;

    public function __construct()
    {
        $this->film = new ArrayCollection();
        $this->movie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatue(): ?string
    {
        return $this->statue;
    }

    public function setStatue(string $statue): self
    {
        $this->statue = $statue;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
            $film->setStatue($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        if ($this->film->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getStatue() === $this) {
                $film->setStatue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovie(): Collection
    {
        return $this->movie;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movie->contains($movie)) {
            $this->movie[] = $movie;
            $movie->setStatue($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movie->removeElement($movie)) {
            // set the owning side to null (unless already changed)
            if ($movie->getStatue() === $this) {
                $movie->setStatue(null);
            }
        }

        return $this;
    }
}
