<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OkresyKonfiguracja
 *
 * @ORM\Table(name="sfz_okresy_konfiguracja")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\OkresyKonfiguracjaRepository")
 */
class OkresyKonfiguracja
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
     * @var string
     *
     * @ORM\Column(name="rok", type="string", length=4, unique=true)
     */
    protected $rok;

    /**
     * Aleksandro?
     *
     * @var bool
     *
     * @ORM\Column(name="o1u", type="boolean", nullable=true)
     */
    protected $o1u;

    /**
     * Osu?
     *
     * @var bool
     *
     * @ORM\Column(name="o2u", type="boolean", nullable=true)
     */
    protected $o2u;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rok
     *
     * @param string $rok
     *
     * @return OkresyKonfiguracja
     */
    public function setRok($rok)
    {
        $this->rok = $rok;

        return $this;
    }

    /**
     * Get rok
     *
     * @return string
     */
    public function getRok()
    {
        return $this->rok;
    }

    /**
     * Set o1u
     *
     * @param bool $o1u
     *
     * @return OkresyKonfiguracja
     */
    public function setO1u($o1u)
    {
        $this->o1u = $o1u;

        return $this;
    }

    /**
     * Get o1u
     *
     * @return bool
     */
    public function getO1u()
    {
        return $this->o1u;
    }

    /**
     * Set o2u
     *
     * @param bool $o2u
     *
     * @return OkresyKonfiguracja
     */
    public function setO2u($o2u)
    {
        $this->o2u = $o2u;

        return $this;
    }

    /**
     * Get o2u
     *
     * @return bool
     */
    public function getO2u()
    {
        return $this->o2u;
    }
}
