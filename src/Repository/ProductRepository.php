<?php

namespace App\Repository;

use App\Entity\Product;
use App\Interface\ProductsFiltersInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $product, bool $flush = true): void
    {
        $em = $this->getEntityManager();
        $em->persist($product);
        if ($flush) {
            $em->flush();
        }
    }

   public function findProducts(ProductsFiltersInterface $productsFilters): array
   {
       $query = $this->createQueryBuilder('p')
           ->select("p.id, p.name, p.description, p.priceIncludingVat AS price")
           ->setFirstResult($productsFilters->initialRow())
           ->setMaxResults($productsFilters->getMaxResults())
           ->orderBy('p.name', 'ASC');

        $query = $this->query($query, $productsFilters->getName());

        return $query
            ->getQuery()
            ->getResult();
   }

   public function getPages(ProductsFiltersInterface $productsFilters) : array
   {
        $query = $this->createQueryBuilder('p')
        ->select("count(p.id) AS numberRows");

        $query = $this->query($query, $productsFilters->getName());

        return $query
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function query(ORMQueryBuilder $query, ?string $name) : ORMQueryBuilder
    {
        $query 
            ->where("p.enabled = true");

        if (!empty($name)) {
            $query 
                ->andWhere("p.name LIKE :name")
                ->setParameter("name","%$name%");            
        }

        return $query;
    }
}
