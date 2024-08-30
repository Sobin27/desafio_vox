<?php
namespace App\Repository\Socios\Concrete;

use App\ApiResource\Dto\SocioDto;
use App\Entity\Socios;
use App\Repository\Config\EntityManagerService;
use App\Repository\Socios\Abstract\ISociosRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpKernel\Log\Logger;

/**
 * @extends ServiceEntityRepository<Socios>
 */
class SociosRepository extends EntityManagerService implements ISociosRepository
{
    public function createSocio(SocioDto $dto): bool
    {
        try {
            $socio = new Socios();
            $socio->setName($dto->getName());
            $socio->setCpf($dto->getCpf());
            $socio->setEmail($dto->getEmail());
            $socio->setEmpresa($dto->getEmpresa());
            $this->entityManager->persist($socio);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }

    public function findByCpf(string $cpf): array
    {
        return $this->entityManager->createQuery(
            'SELECT s FROM App\Entity\Socios s WHERE s.cpf = :cpf'
        )->setParameter('cpf', $cpf)->getResult();
    }

    public function updateSocio(Socios $socios): bool
    {
        try {
            $this->entityManager->persist($socios);
            $this->entityManager->flush();
            return true;
        }catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }
    public function findById(int $id): Socios
    {
        return $this->entityManager->find(Socios::class, $id);
    }

    public function listSocios(): array
    {
        return $this->entityManager->createQuery(
            'SELECT s.id, s.name, s.cpf, s.cpf, e.nome_fantasia FROM App\Entity\Socios s
            join s.empresa e
            ORDER BY e.id ASC'
        )->getResult();
    }

    public function deleteSocio(Socios $socios): bool
    {
        try {
            $this->entityManager->remove($socios);
            $this->entityManager->flush();
            return true;
        }catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }
}
