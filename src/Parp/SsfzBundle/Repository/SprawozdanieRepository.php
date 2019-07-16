<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Service\TypSprawozdaniaGuesserService;

/**
 * Repozytorium SprawozdanieRepository.
 *
 * Centralizuje dostęp do danych sprawozdań różnych typów.
 * Repozytorium nie jest powiązane z żadną encją. Jest zdefiniowane jako usługa.
 */
class SprawozdanieRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TypSprawozdaniaGuesserService
     */
    private $guesser;

    /**
     * Konstruktor.
     *
     * @param EntityManager $entityManager
     * @param TypSprawozdaniaGuesserService $guesser
     */
    public function __construct(EntityManager $entityManager, TypSprawozdaniaGuesserService $guesser)
    {
        $this->entityManager = $entityManager;
        $this->guesser = $guesser;
    }

    /**
     * Szuka sprawozdania właściwego typu wg zadanych identyfikatorów umowy i sprawozdania.
     *
     * @param int $idUmowy
     * @param int $idSprawozdania
     *
     * @return AbstractSprawozdanie|null
     */
    public function findByIdUmowyAndIdSprawozdania(int $idUmowy, int $idSprawozdania): ?AbstractSprawozdanie
    {
        $entityManager = $this->entityManager;
        $guesser = $this->guesser;

        $umowa = $entityManager
            ->getRepository(Umowa::class)
            ->find($idUmowy)
        ;
        if (null === $umowa) {
            throw new EntityNotFoundException('Nie znaleziono umowy o podanym identyfikatorze.');
        }

        $program = $umowa->getBeneficjent()->getProgram();
        $typSprawozdania = $guesser->guessByProgram($program);
        $klasaSprawozdania = $guesser->getClass($typSprawozdania);

        $sprawozdanie = $entityManager
            ->getRepository($klasaSprawozdania)
            ->find($idSprawozdania)
        ;
        if (null === $sprawozdanie) {
            throw new EntityNotFoundException('Nie znaleziono sprawozdania o podanym identyfikatorze.');
        }

        return $sprawozdanie;
    }
}
