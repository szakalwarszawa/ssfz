<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wojewodztwo
 *
 * @ORM\Table(name="sfz_wojewodztwo")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\WojewodztwoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Wojewodztwo
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
     * @ORM\Column(name="nazwa", type="string", length=60)
     */
    private $nazwa;

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
     * Get kod
     *
     * @return string 
     */
    public function getKod()
    {
        return $this->kod;
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
     * 
     * @param string $nazwa
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }
}
