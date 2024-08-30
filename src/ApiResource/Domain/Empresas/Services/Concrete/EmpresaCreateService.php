<?php
namespace App\ApiResource\Domain\Empresas\Services\Concrete;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaCreateService;
use App\ApiResource\Dto\EmpresaDto;
use App\Repository\Empresas\Abstract\IEmpresasRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EmpresaCreateService implements IEmpresaCreateService
{
    private EmpresaDto $dto;
    public function __construct(
        private readonly IEmpresasRepository $empresasRepository,
    )
    { }
    public function createEmpresaService(Request $request): bool
    {
        $this->validateRequest($request);
        $this->checkIfCnpjExists();
        return $this->empresasRepository->createEmpresa($this->dto);
    }
    private function validateRequest(Request $request): void
    {
        $data = $request->toArray();
        $this->dto = new EmpresaDto();
        $this->dto->setNomeFantasia($data['nomeFantasia']);
        $this->dto->setRazaoSocial($data['razaoSocial']);
        $this->dto->setCnpj($data['cnpj']);
    }
    private function checkIfCnpjExists(): void
    {
        if ($this->empresasRepository->findByCnpj($this->dto->getCnpj())) {
            throw new BadRequestHttpException('CNPJ já cadastrado');
        }
    }
}