<?php
namespace App\ApiResource\Dto;

use App\Entity\Socios;

class EmpresaDto
{
    private string $razaoSocial;
    private string $nomeFantasia;
    private string $cnpj;

    public function getRazaoSocial(): string
    {
        return $this->razaoSocial;
    }
    public function setRazaoSocial(string $razaoSocial): static
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }
    public function getNomeFantasia(): string
    {
        return $this->nomeFantasia;
    }
    public function setNomeFantasia(string $nomeFantasia): static
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }
    public function getCnpj(): string
    {
        return $this->cnpj;
    }
    public function setCnpj(string $cnpj): static
    {
        $this->cnpj = $cnpj;
        return $this;
    }
}