<?php
namespace App\Controller;

use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaCreateService;
use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaDeleteService;
use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaListService;
use App\ApiResource\Domain\Empresas\Services\Abstract\IEmpresaUpdateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EmpresasController extends AbstractController
{
    public function __construct(
        private readonly IEmpresaCreateService $empresaCreateService,
        private readonly IEmpresaUpdateService $empresaUpdateService,
        private readonly IEmpresaListService $empresaListService,
        private readonly IEmpresaDeleteService $empresaDeleteService,
    )
    { }

    #[Route('api/empresa/create', name: 'create_empresa', methods: ['POST'])]
    public function create(Request $request): Response
    {
        try {
            return new JsonResponse(
                data: $this->empresaCreateService->createEmpresaService($request),
                status: Response::HTTP_CREATED,
                headers: ['message' => 'Empresa cadastrada com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/empresa/update', name: 'update_empresa', methods: ['PUT'])]
    public function update(Request $request): Response
    {
        try {
            return new JsonResponse(
                data: $this->empresaUpdateService->updateEmpresa($request),
                status: Response::HTTP_OK,
                headers: ['message' => 'Empresa atualizada com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/empresa/list', name: 'list_empresa', methods: ['GET'])]
    public function list(SerializerInterface $serializer): Response
    {
        try {
            return new JsonResponse(
                data: $this->empresaListService->listEmpresas(),
                status: Response::HTTP_OK,
                headers: ['message' => 'Listagem de empresas feita com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/empresa/delete/{id}', name: 'delete_empresa', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        try {
            return new JsonResponse(
                data: $this->empresaDeleteService->deleteEmpresa($id),
                status: Response::HTTP_OK,
                headers: ['message' => 'Empresa deletada com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
