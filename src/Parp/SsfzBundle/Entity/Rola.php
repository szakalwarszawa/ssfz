<?php

namespace Parp\SsfzBundle\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rola
 *
 * @ORM\Table(name="sfz_rola")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\RolaRepository")
 */
class Rola implements Serializable
{
    const ROLE_KOORDYNATOR_TECHNICZNY = 1;
    const ROLE_KOORDYNATOR_MERYTORYCZNY = 2;
    const ROLE_PRACOWNIK_PARP = 3;
    const ROLE_BENEFICJENT = 4;
    
    const NAZWY_ROL_PARP = [
        'ROLE_KOORDYNATOR_TECHNICZNY',
        'ROLE_KOORDYNATOR_MERYTORYCZNY',
        'ROLE_PRACOWNIK_PARP',
    ];

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
     * @ORM\Column(name="nazwa", type="string", length=64, unique=true)
     */
    protected $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=64, unique=true, nullable=true)
     */
    protected $opis;

    /**
     * Konstruktor.
     *
     * @param string $nazwa
     */
    public function __construct($nazwa = '')
    {
        $this->nazwa = $nazwa;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNazwa();
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

    /**
     * Zwraca opis roli
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Ustawia opis roli
     *
     * @param type $opis
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->nazwa,
            $this->opis
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nazwa,
            $this->opis
        ) = unserialize($serialized);
    }
}
