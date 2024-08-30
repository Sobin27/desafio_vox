<?php
namespace App\ApiResource\Domain\Socios\Services\Concrete;

use App\ApiResource\Domain\Socios\Services\Abstract\ISocioDeleteService;
use App\Entity\Socios;
use App\Repository\Socios\Abstract\ISociosRepository;

class SocioDeleteService implements ISocioDeleteService
{
    private Socios $socios;

    public function __construct(
        private readonly ISociosRepository $sociosRepository
    )
    { }

    public function deleteSocio(int $id): bool
    {
        $this->setSocios($id);
        return $this->sociosRepository->deleteSocio($this->socios);
    }
    private function setSocios(int $id): void
    {
        $this->socios = $this->sociosRepository->findById($id);
    }
}