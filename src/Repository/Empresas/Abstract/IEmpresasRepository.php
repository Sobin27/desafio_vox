<?php
namespace App\Repository\Empresas\Abstract;

use App\ApiResource\Dto\EmpresaDto;
use App\Entity\Empresas;

interface IEmpresasRepository
{
    public function createEmpresa(EmpresaDto $empresaDto): bool;
    public function findByCnpj(string $cnjp): array;
    public function findById(int $id): Empresas;
    public function updateEmpresa(Empresas $empresas): bool;
    public function listEmpresas(): array;
    public function deleteEmpresa(Empresas $empresas): bool;
}