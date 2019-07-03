<?php

namespace Parp\SsfzBundle\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;

/**
 * SprawozdaniePoreczenioweSkladnikOgolem
 *
 * @ORM\Table(name="sfz_sprawozdanie_poreczeniowe_skladnik_ogolem")
 * @ORM\Entity
 */
class SprawozdaniePoreczenioweSkladnikOgolem extends AbstractSprawozdanieSkladnik
{
    /**
     * Sprawozdanie.
     *
     * @var SprawozdaniePoreczeniowe
     *
     * @ORM\ManyToOne(
     *     targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe",
     *     inversedBy="skladnikiOgolem",
     *     cascade = {"persist"}
     * )
     * @ORM\JoinColumn(name="sprawozdanie_poreczeniowe_id", referencedColumnName="id")
     */
    protected $sprawozdanie;

    /**
     * Set sprawozdanie
     *
     * @param SprawozdaniePoreczeniowe $sprawozdanie
     *
     * @return SprawozdaniePoreczenioweSkladnikOgolem
     */
    public function setSprawozdanie(SprawozdaniePoreczeniowe $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Get sprawozdanie
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }
}
