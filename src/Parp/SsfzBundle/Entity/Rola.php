<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rola
 *
 * @ORM\Table(name="sfz_rola")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\RolaRepository")
 */
class Rola implements \Serializable
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
     * @ORM\Column(name="nazwa", type="string", length=64, unique=true)
     */
    private $nazwa;

    /**
     * @var string
     * 
     * @ORM\Column(name="opis", type="string", length=64, unique=true, nullable=true)
     */
    private $opis;

    const NAZWY_ROL_PARP = ['ROLE_KOORDYNATOR_TECHNICZNY', 'ROLE_KOORDYNATOR_MERYTORYCZNY', 'ROLE_PRACOWNIK_PARP'];
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
     * 
     * @return Object
     */
    public function serialize()
    {
        return serialize(
            array(
            $this->id,
            $this->nazwa,
            $this->opis
            )
        );
    }

    /**
     * 
     * @param Object $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nazwa,
            $this->opis
            ) = unserialize($serialized);
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNazwa();
    }
}
