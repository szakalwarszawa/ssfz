<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Service;

use InvalidArgumentException;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Form\Type\SprawozdanieZalazkoweType;
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
    const SPRAWOZDANIE_ZALAZKOWE = 'sprawozdanie_zalazkowe';

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
    public function exceptionsOn(): TypSprawozdaniaGuesserService
    {
        $this->throwsExceptions = true;

        return $this;
    }

    /**
     * Wyłącza rzucanie wyjątków.
     *
     * @return TypSprawozdaniaGuesserService
     */
    public function exceptionsOff(): TypSprawozdaniaGuesserService
    {
        $this->throwsExceptions = false;

        return $this;
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
    public function guess(AbstractSprawozdanie $sprawozdanie): string
    {
        if ($sprawozdanie instanceof SprawozdanieZalazkowe) {
            return self::SPRAWOZDANIE_ZALAZKOWE;
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
     * Na podstawie programu zwraca typ sprawozdania.
     *
     * @param Program $program
     *
     * @return string
     *
     * @throws InvalidArgumentException Jeśli nie można określić dokładnego typu sprawozdania
     */
    public function guessByProgram(Program $program): string
    {
        if ($program->czyFunduszZalazkowy()) {
            return self::SPRAWOZDANIE_ZALAZKOWE;
        }
 
        if ($program->czyFunduszPozyczkowy()) {
            return self::SPRAWOZDANIE_POZYCZKOWE;
        }
    
        if ($program->czyFunduszPoreczeniowy()) {
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
    public function guessFormType(AbstractSprawozdanie $sprawozdanie): string
    {
        if ($sprawozdanie instanceof Sprawozdanie) {
            return SprawozdanieZalazkoweType::class;
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
     * Zwraca nazwę klasy (FQCN) sprawozdania na podstawie jego typu.
     *
     * @param string $typSprawozdania
     *
     * @return string|null
     */
    public function getClass(string $typSprawozdania): ?string
    {
        if ($typSprawozdania === self::SPRAWOZDANIE_ZALAZKOWE) {
            return SprawozdanieZalazkowe::class;
        }

        if ($typSprawozdania === self::SPRAWOZDANIE_POZYCZKOWE) {
            return SprawozdaniePozyczkowe::class;
        }

        if ($typSprawozdania === self::SPRAWOZDANIE_PORECZENIOWE) {
            return SprawozdaniePoreczeniowe::class;
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
    public function jestPozyczkowe(AbstractSprawozdanie $sprawozdanie): bool
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
    public function jestPoreczeniowe(AbstractSprawozdanie $sprawozdanie): bool
    {
        return $this->guess($sprawozdanie) === self::SPRAWOZDANIE_PORECZENIOWE;
    }
}
