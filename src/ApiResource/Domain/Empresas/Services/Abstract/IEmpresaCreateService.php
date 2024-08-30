<?php
namespace App\ApiResource\Domain\Empresas\Services\Abstract;

use Symfony\Component\HttpFoundation\Request;

interface IEmpresaCreateService
{
    public function createEmpresaService(Request $request): bool;
}