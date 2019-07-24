<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Service;

use InvalidArgumentExcpetion;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bridge\Twig\TwigEngine;
use Parp\SsfzBundle\Repository\SprawozdanieRepository;
use Parp\SsfzBundle\Entity\SprawozdanieInterface;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;
use Parp\SsfzBundle\Entity\SprawozdanieSpolki;
use Parp\SsfzBundle\Entity\DanePozyczek;
use Parp\SsfzBundle\Entity\DanePoreczen;

class PodgladSprawozdaniaService
{
    /**
     * @var string
     */
    const SPRAWOZDANIE_FUNDUSZU_TEMPLATE = 'SsfzBundle:Parp:sprawozdanie.html.twig';

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var SprawozdanieRepository
     */
    private $sprawozdanieRepository;

    /**
     * @var SprawozdanieInterface;
     */
    private $sprawozdanie;

    /**
     * Konstruktor.
     *
     * @param EntityManager $entityManager
     * @param TwigEngine $templating
     * @param SprawozdanieRepository $sprawozdanieRepository
     */
    public function __construct(
        EntityManager $entityManager,
        TwigEngine $templating,
        SprawozdanieRepository $sprawozdanieRepository)
    {
        $this->entityManager = $entityManager;
        $this->templating = $templating;
        $this->sprawozdanieRepository = $sprawozdanieRepository;
    }

    /**
     * Ustala sprawozdanie, dla którego generowany będzie raport.
     *
     * @param SprawozdanieInterface $sprawozdanie
     *
     * @return PodgladSprawozdaniaService
     */
    public function setSprawozdanie(SprawozdanieInterface $sprawozdanie): PodgladSprawozdaniaService
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Znajduje sprawozdanie wg identyfikatorów umowy i sprawozdania.
     *
     * @param int $idUmowy
     * @param int $idSprawozdania
     *
     * @return PodgladSprawozdaniaService
     *
     * @throws EntityNotFoundException Jeśli nie znaleziono sprawozdania.
     */
    public function findSprawozdanie(int $idUmowy, int $idSprawozdania): PodgladSprawozdaniaService
    {
        $sprawozdanie = $this
            ->sprawozdanieRepository
            ->findByIdUmowyAndIdSprawozdania($idUmowy, $idSprawozdania)
        ;
        if (null === $sprawozdanie) {
            throw new EntityNotFoundException('Nie znaleziono zprawozdania.');
        }

        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Wyświetla podgląd sprawozdania Funduszu Pożyczkowego lub Poręczeniowego.
     *
     * Identyfikator umowy jest konieczny do określenia, którego z programów dotyczy sprawozdanie
     * (oraz jakiej klasy obiekty używać i gdzie są przechowywane w bazie danych).
     * Wcześniej SSFZ obsługiwało jeden program i identyfikator sprawozdania był informacją
     * jednoznaczną.
     *
     * @return string
     *
     * @throws EntityNotFoundException Jeśli nie znaleziono sprawozdania.
     */
    public function generujSprawozdanieSpo(): string
    {
        $entityManager = $this->entityManager;

        $sprawozdanie = $this->sprawozdanie;
        if (null === $sprawozdanie) {
            throw new InvalidArgumentException('Nie określono sprawozdania dla raportu.');
        }
        $idSprawozdania = $sprawozdanie->getId();

        $program = $sprawozdanie
            ->getUmowa()
            ->getBeneficjent()
            ->getProgram()
        ;

        $sprawozdaniaSpolek = null;
        $przeplywFinansowy = null;
        if ($program->czyFunduszZalazkowy()) {
            $przeplywFinansowy = $entityManager
                ->getRepository(PrzeplywFinansowy::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;
            $sprawozdaniaSpolek = $entityManager
                ->getRepository(SprawozdanieSpolki::class)
                ->findByIdSprawozdania($idSprawozdania)
            ;
        }

        $danePozyczek = null;
        $danePozyczekZagregowane = null;
        if ($program->czyFunduszPozyczkowy()) {
            $danePozyczek = $entityManager
                ->getRepository(DanePozyczek::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;

            $danePozyczekZagregowane = $entityManager
                ->getRepository(DanePozyczek::class)
                ->findDaneZagregowaneByIdSprawozdania($idSprawozdania)
            ;
        }

        $danePoreczen = null;
        if ($program->czyFunduszPoreczeniowy()) {
            $danePoreczen = $entityManager
                ->getRepository(DanePoreczen::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;
        }

        return $this
            ->templating
            ->render(self::SPRAWOZDANIE_FUNDUSZU_TEMPLATE, [
                'sprawozdanie'              => $sprawozdanie,
                'sprawozdania_spolek'       => $sprawozdaniaSpolek,
                'przeplyw_finansowy'        => $przeplywFinansowy,
                'dane_pozyczek'             => $danePozyczek,
                'dane_pozyczek_zagregowane' => $danePozyczekZagregowane,
                'dane_poreczen'             => $danePoreczen,
            ]);
    }
}
