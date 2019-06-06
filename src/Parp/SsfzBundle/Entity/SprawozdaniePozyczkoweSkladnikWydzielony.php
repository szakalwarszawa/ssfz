<?php

namespace Parp\SsfzBundle\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;

/**
 * SprawozdaniePozyczkoweSkladnikWydzielony
 *
 * @ORM\Table(name="sfz_sprawozdanie_pozyczkowe_skladnik_wydzielony")
 * @ORM\Entity
 */
class SprawozdaniePozyczkoweSkladnikWydzielony extends AbstractSprawozdanieSkladnik
{
    /**
     * Sprawozdanie.
     *
     * @var SprawozdaniePozyczkowe
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe", inversedBy="skladnikiOgolem", cascade = {"persist"})
     * @ORM\JoinColumn(name="sprawozdanie_pozyczkowe_id", referencedColumnName="id")
     */
    protected $sprawozdanie;

    /**
     * Set sprawozdanie
     *
     * @param SprawozdaniePozyczkowe $sprawozdanie
     *
     * @return SprawozdaniePozyczkoweSkladnikOgolem
     */
    public function setSprawozdanie(SprawozdaniePozyczkowe $sprawozdanie = null)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Get sprawozdanie
     *
     * @return SprawozdaniePozyczkowe
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }
}
