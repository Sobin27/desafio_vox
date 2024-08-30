<?php
namespace App\ApiResource\Domain\Empresas\Services\Concrete;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaListService;
use App\Repository\Empresas\Abstract\IEmpresasRepository;

class EmpresaListService implements IEmpresaListService
{
    public function __construct(
        private readonly IEmpresasRepository $empresasRepository,
    )
    { }

    public function listEmpresas(): array
    {
        return $this->empresasRepository->list();
    }
}