<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\DBAL\Types\Types;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\MetaData\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext:['groups'=>'client:item']),
            new GetCollection(normalizationContext:['groups'=>'client:list'])])]

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['client:list','client:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]

    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $adresseRue = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $codePostale = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $courriel = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $telFixe = null;

    #[ORM\Column(length: 255)]
    #[groups(['client:list','client:item'])]
    private ?string $telPortable = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Location::class)]
    #[groups(['client:list','client:item'])]
    private Collection $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresseRue(): ?string
    {
        return $this->adresseRue;
    }

    public function setAdresseRue(string $adresseRue): static
    {
        $this->adresseRue = $adresseRue;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->codePostale;
    }

    public function setCodePostale(string $codePostale): static
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(string $courriel): static
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(string $telFixe): static
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(string $telPortable): static
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): static
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setClient($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): static
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getClient() === $this) {
                $location->setClient(null);
            }
        }

        return $this;
    }
}
