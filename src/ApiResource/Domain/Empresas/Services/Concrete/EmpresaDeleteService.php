<?php
namespace App\ApiResource\Domain\Empresas\Services\Concrete;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaDeleteService;
use App\Entity\Empresas;
use App\Repository\Empresas\Abstract\IEmpresasRepository;

class EmpresaDeleteService implements IEmpresaDeleteService
{
    private Empresas $empresas;
    public function __construct(
        private readonly IEmpresasRepository $empresaRepository,
    )
    { }

    public function deleteEmpresa(int $id): bool
    {
        $this->setEmpresa($id);
        return $this->empresaRepository->deleteEmpresa($this->empresas);
    }
    private function setEmpresa(int $id): void
    {
        $this->empresas = $this->empresaRepository->findById($id);
    }
}