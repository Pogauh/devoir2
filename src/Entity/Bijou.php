<?php

namespace App\Entity;

use App\Repository\BijouRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\MetaData\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext:['groups'=>'bijou:item']),
            new GetCollection(normalizationContext:['groups'=>'bijou:list'])])]


#[ORM\Entity(repositoryClass: BijouRepository::class)]
class Bijou
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['bijou:list','bijou:item'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[groups(['bijou:list','bijou:item'])]
    private ?string $description = null;

    #[ORM\Column]
    #[groups(['bijou:list','bijou:item'])]
    private ?int $prixVente = null;

    #[ORM\Column]
    #[groups(['bijou:list','bijou:item'])]
    private ?int $prixLocation = null;

    #[ORM\ManyToOne(inversedBy: 'bijous')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixVente(): ?int
    {
        return $this->prixVente;
    }

    public function setPrixVente(int $prixVente): static
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getPrixLocation(): ?int
    {
        return $this->prixLocation;
    }

    public function setPrixLocation(int $prixLocation): static
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

   
}
