<?php
namespace App\ApiResource\Domain\Empresas\Services\Concrete;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaUpdateService;
use App\Entity\Empresas;
use App\Repository\Empresas\Abstract\IEmpresasRepository;
use Symfony\Component\HttpFoundation\Request;

class EmpresaUpdateService implements IEmpresaUpdateService
{
    private Empresas $empresas;
    public function __construct(
        private readonly IEmpresasRepository $empresasRepository,
    )
    { }
    public function updateEmpresa(Request $request): bool
    {
        $this->setEmpresa($request->toArray()['id']);
        $this->setResquest($request);
        return $this->empresasRepository->update($this->empresas);
    }
    private function setResquest(Request $request): void
    {
        $data = $request->toArray();
        $this->empresas->setNomeFantasia($data['nomeFantasia'] ?? $this->empresas->getNomeFantasia());
        $this->empresas->setRazaoSocial($data['razaoSocial']) ?? $this->empresas->getRazaoSocial();
    }
    private function setEmpresa(int $id): void
    {
        $this->empresas = $this->empresasRepository->findById($id);
    }
}