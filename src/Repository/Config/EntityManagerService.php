<?php
namespace App\Repository\Config;

use Doctrine\ORM\EntityManagerInterface;

abstract class EntityManagerService
{
    protected EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}