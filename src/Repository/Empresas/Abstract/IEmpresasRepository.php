<?php
namespace App\Repository\Empresas\Abstract;

use App\ApiResource\Dto\EmpresaDto;
use App\Entity\Empresas;

interface IEmpresasRepository
{
    public function create(EmpresaDto $empresaDto): bool;
    public function findByCnpj(string $cnjp): array;
    public function findById(int $id): Empresas;
    public function update(Empresas $empresas): bool;
    public function list(): array;
    public function delete(Empresas $empresas): bool;
}