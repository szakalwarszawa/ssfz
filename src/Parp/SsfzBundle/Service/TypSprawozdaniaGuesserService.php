<?php

namespace Parp\SsfzBundle\Service;

use InvalidArgumentException;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Form\Type\SprawozdanieType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePozyczkoweType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePoreczenioweType;

/**
 * Usługa określająca typ sprawozdania.
 */
class TypSprawozdaniaGuesserService
{
    /**
     * @var string
     */
    const SPRAWOZDANIE = 'sprawozdanie_standardowe';

    /**
     * @var string
     */
    const SPRAWOZDANIE_POZYCZKOWE = 'sprawozdanie_pozyczkowe';

    /**
     * @var string
     */
    const SPRAWOZDANIE_PORECZENIOWE = 'sprawozdanie_poreczeniowe';

    /**
     * @var string
     */
    const INNE_SPRAWOZDANIE = 'inne_sprawozdanie';

    /**
     * Określa, czy w przypadku niepowodzenia zagadywania/określania powinny być rzucane wyjątki.
     *
     * @var bool
     */
    private $throwsExceptions = false;

    /**
     * Włącza rzucanie wyjątków.
     *
     * @return TypSprawozdaniaGuesserService
     */
    public function exceptionsOn()
    {
        $this->throwsExceptions = true;
    }

    /**
     * Wyłącza rzucanie wyjątków.
     *
     * @return TypSprawozdaniaGuesserService
     */
    public function exceptionsOff()
    {
        $this->throwsExceptions = false;
    }

    /**
     * Na podstawie typu obiektu zwraca typ sprawozdania
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return string
     *
     * @throws InvalidArgumentException Jeśli nie można określić dokładnego typu sprawozdania
     */
    public function guess(AbstractSprawozdanie $sprawozdanie)
    {
        if ($sprawozdanie instanceof Sprawozdanie) {
            return self::SPRAWOZDANIE;
        }

        if ($sprawozdanie instanceof SprawozdaniePozyczkowe) {
            return self::SPRAWOZDANIE_POZYCZKOWE;
        }

        if ($sprawozdanie instanceof SprawozdaniePoreczeniowe) {
            return self::SPRAWOZDANIE_PORECZENIOWE;
        }

        if ($this->throwsExceptions) {
            throw new InvalidArgumentException('Can not determine type of "Sprawozdanie".');
        }
        
        return self::INNE_SPRAWOZDANIE;
    }

    /**
     * Na podstawie typu obiektu zwraca typ sprawozdania
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return string|null
     *
     * @throws InvalidArgumentException Jeśli nie można określić typu formularza dla sprawozdania
     */
    public function guessFormType(AbstractSprawozdanie $sprawozdanie)
    {
        if ($sprawozdanie instanceof Sprawozdanie) {
            return SprawozdanieType::class;
        }

        if ($sprawozdanie instanceof SprawozdaniePozyczkowe) {
            return SprawozdaniePozyczkoweType::class;
        }

        if ($sprawozdanie instanceof SprawozdaniePoreczeniowe) {
            return SprawozdaniePoreczenioweType::class;
        }

        if ($this->throwsExceptions) {
            throw new InvalidArgumentException('Can not determine form type for "Sprawozdanie".');
        }

        return null;
    }

    /**

     * Określa czy sprawozdanie dotyczy pożyczek.
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return bool
     */
    public function jestPozyczkowe(AbstractSprawozdanie $sprawozdanie)
    {
        return $this->guess($sprawozdanie) === self::SPRAWOZDANIE_POZYCZKOWE;
    }

    /**
     * Określa czy sprawozdanie dotyczy poręczeń.
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return bool
     */
    public function jestPoreczeniowe(AbstractSprawozdanie $sprawozdanie)
    {
        return $this->guess($sprawozdanie) === self::SPRAWOZDANIE_PORECZENIOWE;
    }
}
