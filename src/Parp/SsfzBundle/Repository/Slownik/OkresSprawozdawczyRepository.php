<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository\Slownik;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;
use Parp\SsfzBundle\Entity\Slownik\Program;

/**
 * Repozytorium OkresSprawozdawczyRepository.
 */
class OkresSprawozdawczyRepository extends EntityRepository
{
    /**
     * Znajduje okresy sprawozdawcze o rocznej częstotliwości.
     *
     * @return OkresSprawozdawczy[]
     */
    public function findRoczneOkresy(): array
    {
        $intervals = [];

        $result = $this
            ->createQueryBuilder('os')
            ->where('os.id IS NOT NULL')
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        foreach ($result as $key => $value) {
            if ($value->jestRoczny()) {
                $intervals[$key] = $value;
            }
        }

        return $intervals;
    }

    /**
     * Znajduje okresy sprawozdawcze o półrocznej częstotliwości.
     *
     * @return OkresSprawozdawczy[]
     */
    public function findPolroczneOkresy(): array
    {
        $intervals = [];

        $result = $this
            ->createQueryBuilder('os')
            ->where('os.id IS NOT NULL')
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;

        foreach ($result as $key => $value) {
            if ($value->jestPolroczny()) {
                $intervals[$key] = $value;
            }
        }

        return $intervals;
    }
}
