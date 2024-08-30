<?php
namespace App\Repository\Socios\Abstract;

use App\ApiResource\Dto\SocioDto;
use App\Entity\Socios;

interface ISociosRepository
{
    public function createSocio(SocioDto $dto): bool;
    public function findByCpf(string $cpf): array;
    public function findById(int $id): Socios;
    public function updateSocio(Socios $socios): bool;
    public function listSocios(): array;
    public function deleteSocio(Socios $socios): bool;
}