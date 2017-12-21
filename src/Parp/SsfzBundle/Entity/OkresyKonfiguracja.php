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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="rok", type="string", length=4, unique=true)
     */
    private $rok;

    /**
     * @var bool
     *
     * @ORM\Column(name="o1u", type="boolean", nullable=true)
     */
    private $o1u;

    /**
     * @var bool
     *
     * @ORM\Column(name="o2u", type="boolean", nullable=true)
     */
    private $o2u;


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
     * Set rok
     *
     * @param  string $rok
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
     * @param  boolean $o1u
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
     * @return boolean 
     */
    public function getO1u()
    {
        return $this->o1u;
    }

    /**
     * Set o2u
     *
     * @param  boolean $o2u
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
     * @return boolean 
     */
    public function getO2u()
    {
        return $this->o2u;
    }
}
