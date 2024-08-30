<?php

namespace App\Controller;

use App\ApiResource\Domain\Socios\Services\Abstract\ISocioCreateService;
use App\ApiResource\Domain\Socios\Services\Abstract\ISocioDeleteService;
use App\ApiResource\Domain\Socios\Services\Abstract\ISocioListService;
use App\ApiResource\Domain\Socios\Services\Abstract\ISocioUpdateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SociosController extends AbstractController
{
    public function __construct(
        private readonly ISocioCreateService $socioCreateService,
        private readonly ISocioUpdateService $socioUpdateService,
        private readonly ISocioListService $socioListService,
        private readonly ISocioDeleteService $socioDeleteService,
    )
    { }

    #[Route('api/socio/create', name: 'create_socio', methods: ['POST'])]
    public function create(Request $request): Response
    {
        try {
            return new JsonResponse(
                data: $this->socioCreateService->createSocio($request),
                status: Response::HTTP_CREATED,
                headers: ['message' => 'Socio cadastrado com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/socio/update', name: 'update_socio', methods: ['PUT'])]
    public function update(Request $request): Response
    {
        try {
            return new JsonResponse(
                data: $this->socioUpdateService->updateSocio($request),
                status: Response::HTTP_CREATED,
                headers: ['message' => 'Socio atualizado com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/socio/list', name: 'list_socio', methods: ['GET'])]
    public function list(SerializerInterface $serializer): Response
    {
        try {
            $socios = $this->socioListService->listSocios();
            $data = $serializer->normalize($socios, null, ['groups' => 'list_socio']);
            return new JsonResponse(
                data: $data,
                status: Response::HTTP_CREATED,
                headers: ['message' => 'Lista de socios realizada com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    #[Route('api/socio/delete/{id}', name: 'delete_socio', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        try {
            return new JsonResponse(
                data: $this->socioDeleteService->deleteSocio($id),
                status: Response::HTTP_CREATED,
                headers: ['message' => 'Lista de socios realizada com sucesso']
            );
        }catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
