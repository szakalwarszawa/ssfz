<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusSprawozdania
 *
 * @ORM\Table(name="slownik_statusow_sprawozdan")
 * @ORM\Entity
 */
class StatusSprawozdania
{
    const EDYCJA = 1;
    const PRZESLANO_DO_PARP = 2;
    const ZAAKCEPTOWANE = 3;
    const POPRAWA = 4;

    /**
     * ID programu.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Nazwa programu.
     *
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=64, unique=true)
     */
    protected $nazwa;

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
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return StatusSprawozdania
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        
        return $this;
    }
    
    /**
     * Czy status to edycja.
     *
     * @return bool
     */
    public function czyEdycja()
    {
        return StatusSprawozdania::EDYCJA === (int) $this->id;
    }
    
    /**
     * Czy status to przesłano do PARP.
     *
     * @return bool
     */
    public function czyPrzeslanoDoParp()
    {
        return StatusSprawozdania::PRZESLANO_DO_PARP === (int) $this->id;
    }
    
    /**
     * Czy status to zaakceptowane.
     *
     * @return bool
     */
    public function czyZaakceptowane()
    {
        return StatusSprawozdania::ZAAKCEPTOWANE === (int) $this->id;
    }
    
    /**
     * Czy status to poprawa.
     *
     * @return bool
     */
    public function czyPoprawa()
    {
        return StatusSprawozdania::POPRAWA === (int) $this->id;
    }
}
