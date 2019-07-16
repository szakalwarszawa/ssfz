<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Sprawozdanie
 *
 * @ORM\Table(name="sfz_sprawozdanie")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdanieZalazkoweRepository")
 */
class SprawozdanieZalazkowe extends AbstractSprawozdanie
{
    /**
     * Encje SprawozdanieSpolki powiazane ze sprawozdaniem - sprawozdania spolek
     *
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="SprawozdanieSpolki",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $sprawozdaniaSpolek;

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->sprawozdaniaSpolek = new ArrayCollection();
    }

    /**
     * Ustawia status powiadomienia
     *
     * @param int $powiadomienieWyslane
     */
    public function setPowiadomienieWyslane($powiadomienieWyslane)
    {
        $this->powiadomienieWyslane = $powiadomienieWyslane;
    }

    /**
     * Set sprawozdaniaSpolek
     *
     * @param SprawozdanieSpolki $spr
     *
     * @return Sprawozdanie
     */
    public function setSprawozdaniaSpolek($spr)
    {
        $this->sprawozdaniaSpolek = $spr;

        return $this;
    }

    /**
     * Get sprawozdaniaSpolek
     *
     * @return Collection
     */
    public function getSprawozdaniaSpolek()
    {
        return $this->sprawozdaniaSpolek;
    }

    /**
     * Funkcja dodająca sprawozdanie spolki do sprawozdania
     *
     * @param SprawozdanieSpolki $sprSpolki
     */
    public function addSprawozdaniaSpolek(SprawozdanieSpolki $sprSpolki)
    {
        $sprSpolki->setSprawozdanie($this);
        $this->sprawozdaniaSpolek->add($sprSpolki);
    }

    /**
     * Funkcja usuwająca sprawozdanie spolki ze sprawozdania
     *
     * @param SprawozdanieSpolki $sprSpolki
     */
    public function removeSprawozdaniaSpolek(SprawozdanieSpolki $sprSpolki)
    {
        $this->sprawozdaniaSpolek->removeElement($sprSpolki);
    }

    /**
     * Znajduje sprawozdanie dla spółki o podanej nazwie
     *
     * @param string $nazwaSpolki
     *
     * @return SprawozdanieSpolki|null
     */
    public function getSprawozdanieSpolki($nazwaSpolki)
    {
        foreach ($this->sprawozdaniaSpolek as $sprawozdanie) {
            if ($sprawozdanie->getNazwaSpolki() == $nazwaSpolki) {
                return $sprawozdanie;
            }
        }

        return null;
    }

    /**
     * @Assert\Callback
     *
     * Metoda sprawdza parametry zdefiniowane dla spolek
     *
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        foreach ($this->sprawozdaniaSpolek as $spolka) {
            $spolka->validate($context);
        }
    }
}