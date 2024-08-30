<?php
namespace App\ApiResource\Domain\Socios\Services\Concrete;

use App\ApiResource\Domain\Socios\Services\Abstract\ISocioListService;
use App\Repository\Socios\Abstract\ISociosRepository;

class SocioListService implements ISocioListService
{
    public function __construct(
        private readonly ISociosRepository $sociosRepository
    )
    { }

    public function listSocios(): array
    {
        return $this->sociosRepository->listSocios();
    }
}