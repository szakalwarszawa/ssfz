<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Slowniki\Skladnik;

/**
 * AbstractSprawozdanieSkladnik
 */
class AbstractSprawozdanieSkladnik
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Sprawozdanie.
     *
     * @var AbstractSprawozdanieSpo
     */
    protected $sprawozdanie;
    
    /**
     * Forma prawna.
     *
     * @var FormaPrawna
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\Skladnik")
     * @ORM\JoinColumn(name="skladnik", referencedColumnName="id", nullable=true)
     */
    protected $skladnik;

    /**
     * Wartość.
     *
     * @var string
     *
     * @ORM\Column(name="wartosc", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $wartosc;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set wartosc
     *
     * @param string $wartosc
     *
     * @return AbstractSprawozdanieSkladnik
     */
    public function setWartosc($wartosc)
    {
        $this->wartosc = $wartosc;

        return $this;
    }

    /**
     * Get wartosc
     *
     * @return string
     */
    public function getWartosc()
    {
        return $this->wartosc;
    }

    /**
     * Set skladnik
     *
     * @param Skladnik $skladnik
     *
     * @return AbstractSprawozdanieSkladnik
     */
    public function setSkladnik(Skladnik $skladnik = null)
    {
        $this->skladnik = $skladnik;

        return $this;
    }

    /**
     * Get skladnik
     *
     * @return Skladnik
     */
    public function getSkladnik()
    {
        return $this->skladnik;
    }
}
