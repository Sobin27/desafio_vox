<?php
namespace App\ApiResource\Domain\Empresas\Services\Abstract;

use Symfony\Component\HttpFoundation\Request;

interface IEmpresaUpdateService
{
    public function updateEmpresa(Request $request): bool;
}