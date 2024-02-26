<?php

namespace App\Repository;

use App\Entity\ValueAddedTax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ValueAddedTax>
 *
 * @method ValueAddedTax|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValueAddedTax|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValueAddedTax[]    findAll()
 * @method ValueAddedTax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValueAddedTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValueAddedTax::class);
    }

   public function getValueAddedTaxActive(): array
   {
       return $this->createQueryBuilder('v')
            ->select("v.id, v.percentage")
            ->where('v.enabled = true')
            ->orderBy('v.percentage', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }

}
