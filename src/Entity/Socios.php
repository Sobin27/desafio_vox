<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\Socios\Concrete\SociosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SociosRepository::class)]
#[ApiResource]
class Socios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list_socios'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_socios'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['list_socios'])]
    private ?string $cpf = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['list_socios'])]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'socios')]
    #[Groups(['list_socios'])]
    private ?Empresas $empresa = null;

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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmpresa(): ?Empresas
    {
        return $this->empresa;
    }

    public function setEmpresa(?Empresas $empresa): static
    {
        $this->empresa = $empresa;

        return $this;
    }
}
