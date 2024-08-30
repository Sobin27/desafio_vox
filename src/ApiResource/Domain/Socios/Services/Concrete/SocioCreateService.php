<?php
namespace App\ApiResource\Domain\Socios\Services\Concrete;

use App\ApiResource\Domain\Socios\Services\Abstract\ISocioCreateService;
use App\ApiResource\Dto\SocioDto;
use App\Entity\Empresas;
use App\Repository\Empresas\Abstract\IEmpresasRepository;
use App\Repository\Socios\Abstract\ISociosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SocioCreateService implements ISocioCreateService
{
    private SocioDto $socioDto;
    private Empresas $empresa;
    public function __construct(
        private readonly IEmpresasRepository $empresasRepository,
        private readonly ISociosRepository $sociosRepository,
    )
    { }

    public function createSocio(Request $request): bool
    {
        $this->setEmpresa($request->toArray());
        $this->validateRequest($request->toArray());
        $this->checkIfCpfExists();
        return $this->sociosRepository->createSocio($this->socioDto);
    }
    private function setEmpresa(array $data): void
    {
        $this->empresa = $this->empresasRepository->findById($data['empresa_id']);
    }
    private function validateRequest(array $data): void
    {
        $this->socioDto = new SocioDto();
        $this->socioDto->setName($data['nome']);
        $this->socioDto->setCpf($data['cpf']);
        $this->socioDto->setEmail($data['email']);
        $this->socioDto->setEmpresa($this->empresa);
    }
    private function checkIfCpfExists(): void
    {
        if ($this->sociosRepository->findByCpf($this->socioDto->getCpf())) {
            throw new BadRequestHttpException('CPF já cadastrado');
        }
    }
}