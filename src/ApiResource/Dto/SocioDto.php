<?php
namespace App\ApiResource\Dto;

use App\Entity\Empresas;

class SocioDto
{
    private string $name;
    private string $cpf;
    private string $email;
    private Empresas $empresa;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }
    public function getCpf(): string
    {
        return $this->cpf;
    }
    public function setCpf(string $cpf): static
    {
        $this->cpf = $cpf;
        return $this;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }
    public function getEmpresa(): Empresas
    {
        return $this->empresa;
    }
    public function setEmpresa(Empresas $empresa): static
    {
        $this->empresa = $empresa;
        return $this;
    }
}