<?php
namespace App\Repository;

use App\Entity\Tool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tool::class);
    }

    public function searchWithFilters(array $filters, int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('t');

        // --- filtres dynamiques ---
        if (!empty($filters['department'])) {
            $qb->andWhere('t.ownerDepartment = :department')
               ->setParameter('department', $filters['department']);
        }

        if (!empty($filters['status'])) {
            $qb->andWhere('t.status = :status')
               ->setParameter('status', $filters['status']);
        }

        if (!empty($filters['min_cost'])) {
            $qb->andWhere('t.monthlyCost >= :min_cost')
               ->setParameter('min_cost', $filters['min_cost']);
        }

        if (!empty($filters['max_cost'])) {
            $qb->andWhere('t.monthlyCost <= :max_cost')
               ->setParameter('max_cost', $filters['max_cost']);
        }

        if (!empty($filters['category'])) {
            $qb->andWhere('t.category = :category')
               ->setParameter('category', $filters['category']);
        }

        // --- pagination ---
        $qb->setFirstResult(($page - 1) * $limit)  // OFFSET
           ->setMaxResults($limit);                // LIMIT

        // total pour pagination
        $paginator = new \Doctrine\ORM\Tools\Pagination\Paginator($qb);

        return [
            'data' => iterator_to_array($paginator),
            'total' => count($paginator),
            'page' => $page,
            'limit' => $limit,
        ];
    }
}
