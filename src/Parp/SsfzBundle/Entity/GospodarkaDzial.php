<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GospodarkaDzial
 *
 * @ORM\Table(name="sfz_gospodarka_dzial")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\GospodarkaDzialRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GospodarkaDzial
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
