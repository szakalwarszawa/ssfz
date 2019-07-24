<?php
namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

/**
 * FormaPrawnaBeneficjenta
 *
 * @ORM\Table(name="slownik_form_prawnych_beneficjentow")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\Slownik\FormaPrawnaBeneficjentaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FormaPrawnaBeneficjenta
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
     * @ORM\Column(name="nazwa", type="string", length=200)
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
