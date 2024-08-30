<?php
namespace App\ApiResource\Domain\Socios\Services\Abstract;

use Symfony\Component\HttpFoundation\Request;

interface ISocioCreateService
{
    public function createSocio(Request $request): bool;
}