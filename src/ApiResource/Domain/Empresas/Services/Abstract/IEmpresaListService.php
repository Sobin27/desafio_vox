<?php
namespace App\ApiResource\Domain\Empresas\Services\Abstract;

use App\Entity\Empresas;

interface IEmpresaListService
{
    public function listEmpresas(): array;
}