<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;

/**
 * SprawozdaniePozyczkoweSkladnikOgolem
 *
 * @ORM\Table(name="sfz_sprawozdanie_pozyczkowe_skladnik_ogolem")
 * @ORM\Entity
 */
class SprawozdaniePozyczkoweSkladnikOgolem extends AbstractSprawozdanieSkladnik
{
    /**
     * Sprawozdanie.
     *
     * @var SprawozdaniePozyczkowe|null
     *
     * @ORM\ManyToOne(
     *     targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe",
     *     inversedBy="skladnikiOgolem",
     *     cascade = {"persist"}
     * )
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
    public function setSprawozdanie(SprawozdaniePozyczkowe $sprawozdanie): SprawozdaniePozyczkoweSkladnikOgolem
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Get sprawozdanie
     *
     * @return SprawozdaniePozyczkowe|null
     */
    public function getSprawozdanie(): ?SprawozdaniePozyczkowe
    {
        return $this->sprawozdanie;
    }
}
