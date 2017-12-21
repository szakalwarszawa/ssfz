<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

/**
 * BeneficjentFormaPrawna
 *
 * @ORM\Table(name="sfz_beneficjent_forma_prawna")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\BeneficjentFormaPrawnaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class BeneficjentFormaPrawna
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
     * @ORM\Column(name="nazwa", type="string", length=200)
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
