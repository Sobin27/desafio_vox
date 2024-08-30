<?php
namespace App\ApiResource\Domain\Empresas\Services\Concrete;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaListService;
use App\Repository\Empresas\Abstract\IEmpresasRepository;

class EmpresaListService implements IEmpresaListService
{
    private array $data = [];
    public function __construct(
        private readonly IEmpresasRepository $empresasRepository,
    )
    { }

    public function listEmpresas(): array
    {
        foreach ($this->empresasRepository->listEmpresas() as $empresa) {
            $empresaData = [
                'id' => $empresa->getId(),
                'razao_social' => $empresa->getRazaoSocial(),
                'nome_fantasia' => $empresa->getNomeFantasia(),
                'cnpj' => $empresa->getCnpj(),
                'socios' => []
            ];
            if (!$empresa->getSocios()->isEmpty()) {
                foreach ($empresa->getSocios()->toArray() as $socio) {
                    $empresaData['socios'][] = [
                        'id' => $socio->getId(),
                        'nome' => $socio->getName(),
                        'cpf' => $socio->getCpf(),
                    ];
                }
            }
            $this->data[] = $empresaData;
        }
        return $this->data;
    }
}