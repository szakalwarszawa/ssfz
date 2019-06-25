<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;

/**
 * Usługa określająca typ sprawozdania.
 */
class TypSprawozdaniaGuesserService
{
    const SPRAWOZDANIE = 'sprawozdanie standardowe';
    const SPRAWOZDANIE_POZYCZKOWE = 'sprawozdanie pozyczkowe';
    const SPRAWOZDANIE_PORECZENIOWE = 'sprawozdanie poreczeniowe';
    const INNE_SPRAWOZDANIE = 'inne sprawozdanie';

    /**
     * Na podstawie typu obiektu zwraca typ sprawozdania
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return string
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

        return INNE_SPRAWOZDANIE;
    }

    /**
     * Określa czy sprawozdanie jest pożyczkowe (dotyczy pożyczek).
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
     * Określa czy sprawozdanie jest poręczeniowe (dotyczy poręczeń).
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
