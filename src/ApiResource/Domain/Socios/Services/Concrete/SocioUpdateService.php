<?php
namespace App\ApiResource\Domain\Socios\Services\Concrete;

use App\ApiResource\Domain\Socios\Services\Abstract\ISocioUpdateService;
use App\ApiResource\Dto\SocioDto;
use App\Entity\Socios;
use App\Repository\Socios\Abstract\ISociosRepository;
use Symfony\Component\HttpFoundation\Request;

class SocioUpdateService implements ISocioUpdateService
{
    private Socios $socios;

    public function __construct(
        private readonly ISociosRepository $sociosRepository,
    )
    { }
    public function updateSocio(Request $request): bool
    {
        $this->setSocios($request->toArray());
        $this->validateRequest($request->toArray());
        return $this->sociosRepository->updateSocio($this->socios);
    }
    private function setSocios(array $data): void
    {
        $this->socios = $this->sociosRepository->findById($data['socio_id']);
    }
    private function validateRequest(array $data): void
    {
        $this->socios->setName($data['nome'] ?? $this->socios->getName());
        $this->socios->setEmail($data['email'] ?? $this->socios->getEmail());
    }
}