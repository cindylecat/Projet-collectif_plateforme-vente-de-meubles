<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, MeubleEco>
     */
    #[ORM\OneToMany(targetEntity: MeubleEco::class, mappedBy: 'parent')]
    private Collection $meubleEcos;

    public function __construct()
    {
        $this->meubleEcos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, MeubleEco>
     */
    public function getMeubleEcos(): Collection
    {
        return $this->meubleEcos;
    }

    public function addMeubleEco(MeubleEco $meubleEco): static
    {
        if (!$this->meubleEcos->contains($meubleEco)) {
            $this->meubleEcos->add($meubleEco);
            $meubleEco->setParent($this);
        }

        return $this;
    }

    public function removeMeubleEco(MeubleEco $meubleEco): static
    {
        if ($this->meubleEcos->removeElement($meubleEco)) {
            // set the owning side to null (unless already changed)
            if ($meubleEco->getParent() === $this) {
                $meubleEco->setParent(null);
            }
        }

        return $this;
    }
}
