<?php
namespace App\ApiResource\Domain\Socios\Services\Abstract;

use Symfony\Component\HttpFoundation\Request;

interface ISocioUpdateService
{
    public function updateSocio(Request $request): bool;
}