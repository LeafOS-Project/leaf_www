<?php

namespace App\Repository;

use App\Entity\LeafOta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LeafOta>
 *
 * @method LeafOta|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeafOta|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeafOta[]    findAll()
 * @method LeafOta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeafOtaRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, LeafOta::class);
    }

    public function save(LeafOta $entity, bool $flush = false): void {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LeafOta $entity, bool $flush = false): void {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Queries the database for the latest full build
     *
     * @param  string $device The device to query - required
     * @param  string $flavor The flavor to query - optional
     * 
     * @return LeafOta|null The build information, if any
     */
    public function getLatestBuildForDevice(string $device, string $flavor = ''): ?LeafOta {
        $q = $this->createQueryBuilder('ota');

        $q->where('ota.device = :device')
            ->setParameter('device', $device)
            ->andWhere('ota.incremental_base IS NULL')
            ->orderBy('ota.datetime', 'DESC');

        if (!empty($flavor)) {
            $q->andWhere('ota.flavor = :flavor')
                ->setParameter('flavor', $flavor);
        }

        return $q
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getLatestOTAForDevice(string $device, string $flavor = ''): ?LeafOta {
        $q = $this->createQueryBuilder('ota');

        $q->where('ota.device = :device')
            ->setParameter('device', $device)
            ->andWhere('ota.incremental_base IS NOT NULL')
            ->orderBy('ota.datetime', 'DESC');

        if (!empty($flavor)) {
            $q->andWhere('ota.flavor = :flavor')
                ->setParameter('flavor', $flavor);
        }

        return $q->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAllBuildsForDevice(string $device, string $flavor = ''): array {
        $q = $this->createQueryBuilder('ota');

        $q->where('ota.device = :device')
            ->setParameter('device', $device)
            ->andWhere('ota.incremental_base IS NULL')
            ->orderBy('ota.datetime', 'DESC');

        if (!empty($flavor)) {
            $q->andWhere('ota.flavor = :flavor')
                ->setParameter('flavor', $flavor);
        }

        return $q->getQuery()
            ->getResult();
    }

    public function getAllOTAsForDevice(string $device, string $flavor = ''): array {
        $q = $this->createQueryBuilder('ota');

        $q->where('ota.device = :device')
            ->setParameter('device', $device)
            ->andWhere('ota.incremental_base IS NOT NULL')
            ->orderBy('ota.datetime', 'DESC');

        if (!empty($flavor)) {
            $q->andWhere('ota.flavor = :flavor')
                ->setParameter('flavor', $flavor);
        }

        return $q->getQuery()
            ->getResult();
    }
}
