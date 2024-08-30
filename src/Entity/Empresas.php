<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\Empresas\Concrete\EmpresasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmpresasRepository::class)]
#[ApiResource]
class Empresas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list_empresa'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_empresa'])]
    private ?string $razao_social = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_empresa'])]
    private ?string $nome_fantasia = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_empresa'])]
    private ?string $cnpj = null;

    /**
     * @var Collection<int, Socios>
     */
    #[ORM\OneToMany(targetEntity: Socios::class, mappedBy: 'empresa')]
    private Collection $socios;

    public function __construct()
    {
        $this->socios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razao_social;
    }

    public function setRazaoSocial(string $razao_social): static
    {
        $this->razao_social = $razao_social;

        return $this;
    }

    public function getNomeFantasia(): ?string
    {
        return $this->nome_fantasia;
    }

    public function setNomeFantasia(string $nome_fantasia): static
    {
        $this->nome_fantasia = $nome_fantasia;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): static
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * @return Collection<int, Socios>
     */
    public function getSocios(): Collection
    {
        return $this->socios;
    }

    public function addSocio(Socios $socio): static
    {
        if (!$this->socios->contains($socio)) {
            $this->socios->add($socio);
            $socio->setEmpresa($this);
        }

        return $this;
    }

    public function removeSocio(Socios $socio): static
    {
        if ($this->socios->removeElement($socio)) {
            // set the owning side to null (unless already changed)
            if ($socio->getEmpresa() === $this) {
                $socio->setEmpresa(null);
            }
        }

        return $this;
    }
}
