<?php
namespace App\ApiResource\Domain\Socios\Services\Abstract;

interface ISocioDeleteService
{
    public function deleteSocio(int $id): bool;
}