<?php
namespace App\ApiResource\Domain\Empresas\Services\Abstract;

interface IEmpresaDeleteService
{
    public function deleteEmpresa(int $id): bool;
}