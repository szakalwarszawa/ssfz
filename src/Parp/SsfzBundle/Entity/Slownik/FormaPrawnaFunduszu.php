<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

/**
 * FormaPrawna
 *
 * @ORM\Table(name="slownik_form_prawnych_funduszy")
 * @ORM\Entity
 */
class FormaPrawnaFunduszu
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
     * @ORM\Column(name="nazwa", type="string", length=200, unique=true))
     */
    protected $nazwa;

    /**
     * Zwraca reprezentację tekstową obiektu.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->nazwa;
    }

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
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }
}
