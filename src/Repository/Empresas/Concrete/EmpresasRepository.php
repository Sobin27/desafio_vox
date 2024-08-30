<?php

namespace App\Repository\Empresas\Concrete;

use App\ApiResource\Dto\EmpresaDto;
use App\Entity\Empresas;
use App\Repository\Config\EntityManagerService;
use App\Repository\Empresas\Abstract\IEmpresasRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Log\Logger;

/**
 * @extends ServiceEntityRepository<Empresas>
 */
class EmpresasRepository extends EntityManagerService implements IEmpresasRepository
{
    public function create(EmpresaDto $empresaDto): bool
    {
        try {
            $empresas = new Empresas();
            $empresas->setCnpj($empresaDto->getCnpj());
            $empresas->setNomeFantasia($empresaDto->getNomeFantasia());
            $empresas->setRazaoSocial($empresaDto->getRazaoSocial());
            $this->entityManager->persist($empresas);
            $this->entityManager->flush();
            return true;
        }catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }
    public function findByCnpj(string $cnjp): array
    {
        return $this->entityManager->createQuery(
            'SELECT e FROM App\Entity\Empresas e WHERE e.cnpj = :cnpj'
        )->setParameter('cnpj', $cnjp)->getResult();
    }
    public function update(Empresas $empresas): bool
    {
        try {
            $this->entityManager->persist($empresas);
            $this->entityManager->flush();
            return true;
        }catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }
    public function findById(int $id): Empresas
    {
        return $this->entityManager->find(Empresas::class, $id);
    }

    public function list(): array
    {
        return $this->entityManager->createQuery(
            'SELECT e FROM App\Entity\Empresas e
            ORDER BY e.id ASC'
        )->getResult();
    }

    public function delete(Empresas $empresas): bool
    {
        try {
            $this->entityManager->remove($empresas);
            $this->entityManager->flush();
            return true;
        }catch (\Exception $e) {
            Logger::class->log(4,$e->getMessage());
            return false;
        }
    }
}
