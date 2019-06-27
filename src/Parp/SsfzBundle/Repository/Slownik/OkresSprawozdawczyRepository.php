<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository\Slownik;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * Repozytorium OkresSprawozdawczyepository.
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
        $dict = [];

        $result = $this
            ->createQueryBuilder('os')
            ->where('os.id IS NOT NULL')
            ->getQuery()
            ->getResult()
        ;
        foreach ($result as $key => $value) {
            if ($value->jestRoczny()) {
                $dict[$key] = $value;
            }
        }

        return $value;
    }

    /**
     * Znajduje okresy sprawozdawcze o półrocznej częstotliwości.
     *
     * @return OkresSprawozdawczy[]
     */
    public function findPolroczneOkresy(): array
    {
        $dict = [];

        $result = $this
            ->createQueryBuilder('os')
            ->where('os.id IS NOT NULL')
            ->getQuery()
            ->getResult()
        ;
        foreach ($result as $key => $value) {
            if ($value->jestPolroczny()) {
                $dict[$key] = $value;
            }
        }

        return $value;
    }
}
