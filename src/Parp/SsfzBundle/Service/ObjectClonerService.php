<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Service;

use InvalidArgumentException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;
use DeepCopy\DeepCopy;
use DeepCopy\Matcher\PropertyMatcher;
use DeepCopy\Matcher\PropertyNameMatcher;
use DeepCopy\Matcher\PropertyTypeMatcher;
use DeepCopy\Filter\KeepFilter;
use DeepCopy\Filter\SetNullFilter;
use DeepCopy\Filter\Doctrine\DoctrineCollectionFilter;
use Parp\SsfzBundle\Service\TypSprawozdaniaGuesserService;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaFunduszu;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaBeneficjenta;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Entity\Slownik\Skladnik;
use Parp\SsfzBundle\Entity\Slownik\StatusSprawozdania;
use Parp\SsfzBundle\Entity\Slownik\TakNie;
use Parp\SsfzBundle\Entity\Slownik\Wojewodztwo;

/**
 * Usługa klonująca obiekty oparta na bibliotece DeepCopy.
 *
 * @see https://github.com/myclabs/DeepCopy
 */
class ObjectClonerService
{
    /**
     * @var TypSprawozdaniaGuesserService
     */
    private $guesser;

    /**
     * @var EntityManager
     */
    private $entityManager;

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
     * Klonuje obiekt sprawozdania.
     *
     * Włączenie flagi "persist" powoduje automatyczne utrwalenie klona i zmian w pierwotnym obiekcie.
     *
     * @param AbstractSprawozdanie $sprawozdanie
     * @param bool $persist
     *
     * @return int
     */
    public function cloneSprawozdanieDoPoprawy(AbstractSprawozdanie $sprawozdanie, $persist = false): AbstractSprawozdanie
    {
        $entityManager = $this->entityManager;
  
        $copier = new DeepCopy(true);
        $copier->addFilter(new SetNullFilter(), new PropertyNameMatcher('id'));
        $copier->addFilter(new KeepFilter(), new PropertyNameMatcher('umowa'));
        $copier->addFilter(new KeepFilter(), new PropertyNameMatcher('okres'));

        $keepUnchangedByType = [
            FormaPrawnaFunduszu::class,
            FormaPrawnaBeneficjenta::class,
            OkresSprawozdawczy::class,
            Program::class,
            Skladnik::class,
            StatusSprawozdania::class,
            TakNie::class,
            Wojewodztwo::class,
        ];
        foreach ($keepUnchangedByType as $type) {
            $copier->addFilter(new KeepFilter(), new PropertyTypeMatcher($type));
        }

        $copier->addFilter(new DoctrineCollectionFilter(), new PropertyTypeMatcher(Collection::class));

        $copy = $copier->copy($sprawozdanie);

        if (false === (bool) $sprawozdanie->getCzyNajnowsza()) {
            throw new InvalidArgumentException('Poprawie podlega jedynie najnowsza wersja sprawozdania.');
        }
        $sprawozdanie->setCzyNajnowsza(false);

        $copy
            ->setCzyNajnowsza(true)
            ->setPreviousVersionId($sprawozdanie->getId())
            ->setWersja($sprawozdanie->getWersja() + 1)
            ->setStatus(StatusSprawozdania::EDYCJA)
            ->setUwagi('')
            ->setOceniajacyId(null)
            ->setDataPrzeslaniaDoParp(null)
            ->setDataZatwierdzenia(null)
        ;

        if ($persist) {
            $entityManager->persist($copy);
            $entityManager->flush();
        }

        return $copy;
    }
}
