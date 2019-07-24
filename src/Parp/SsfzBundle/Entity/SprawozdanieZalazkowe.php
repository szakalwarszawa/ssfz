<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Parp\SsfzBundle\Entity\SprawozdanieSpolki;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;

/**
 * Sprawozdanie
 *
 * @ORM\Table(name="sfz_sprawozdanie")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdanieZalazkoweRepository")
 */
class SprawozdanieZalazkowe extends AbstractSprawozdanie
{
    /**
     * Sprawozdania spółek powiazane ze sprawozdaniem.
     *
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Parp\SsfzBundle\Entity\SprawozdanieSpolki",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $sprawozdaniaSpolek;

    /**
     * Przepływy finansowe powiazane ze sprawozdaniem.
     *
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Parp\SsfzBundle\Entity\PrzeplywFinansowy",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $przeplywyFinansowe;

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->sprawozdaniaSpolek = new ArrayCollection();
        $this->przeplywyFinansowe = new ArrayCollection();
    }

    /**
     * Ustawia status powiadomienia.
     *
     * @param int $powiadomienieWyslane
     */
    public function setPowiadomienieWyslane($powiadomienieWyslane)
    {
        $this->powiadomienieWyslane = $powiadomienieWyslane;

        return $this;
    }

    /**
     * Ustala kolekcję sprawozdań spółek.
     *
     * @param Collection $sprawozdaniaSpolek
     *
     * @return SprawozdanieZalazkowe
     */
    public function setSprawozdaniaSpolek(Collection $sprawozdaniaSpolek)
    {
        $this->sprawozdaniaSpolek = $sprawozdaniaSpolek;

        return $this;
    }

    /**
     * Zwraca kolekcję sprawozdań spółek.
     *
     * @return Collection
     */
    public function getSprawozdaniaSpolek()
    {
        return $this->sprawozdaniaSpolek;
    }

    /**
     * Zwraca liczbę sprawozdań spółek przypisanych do sprawozdania.
     *
     * @return int
     */
    public function countSprawozdaniaSpolek()
    {
        return count($this->sprawozdaniaSpolek);
    }

    /**
     * Dodaje do kolekcji sprawozdanie spółki.
     *
     * @param SprawozdanieSpolki $sprawozdanieSpolki
     *
     * @return SprawozdanieZalazkowe
     */
    public function addSprawozdaniaSpolek(SprawozdanieSpolki $sprawozdanieSpolki)
    {
        $sprawozdanieSpolki->setSprawozdanie($this);
        $this->sprawozdaniaSpolek->add($sprawozdanieSpolki);

        return $this;
    }

    /**
     * Usuwa z kolekcji sprawozdanie spółki.
     *
     * @param SprawozdanieSpolki $sprawozdanieSpolki
     *
     * @return SprawozdanieZalazkowe
     */
    public function removeSprawozdaniaSpolek(SprawozdanieSpolki $sprawozdanieSpolki)
    {
        $this->sprawozdaniaSpolek->removeElement($sprawozdanieSpolki);

        return $this;
    }

    /**
     * Zwraca sprawozdanie spółki dla spółki o zadanej nazwie.
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
     * Ustala kolekcję przepływów finansowych.
     *
     * @param Collection $przeplywyFinansowe
     *
     * @return Sprawozdanie
     */
    public function setPrzeplywyFinansowe(Collection $przeplywyFinansowe)
    {
        $this->przeplywyFinansowe = $przeplywyFinansowe;

        return $this;
    }

    /**
     * Zwraca kolekcję przepływów fianansowych.
     *
     * @return Collection
     */
    public function getPrzeplywyFinansowe()
    {
        return $this->przeplywyFinansowe;
    }

    /**
     * Dodaje przepływ finansowy do kolekcji.
     *
     * @param PrzeplywFinansowy $przeplywFinansowy
     *
     * @return SprawozdanieZalazkowe
     */
    public function addPrzeplywyFinansowe(PrzeplywFinansowy $przeplywFinansowy)
    {
        $$przeplywFinansowy->setSprawozdanie($this);
        $this->przeplywyFinansowe->add($przeplywFinansowy);

        return $this;
    }

    /**
     * Funkcja usuwająca sprawozdanie spolki ze sprawozdania
     *
     * @param PrzeplywFinansowy $przeplywFinansowy
     *
     * @return SprawozdanieZalazkowe
     */
    public function removePrzeplywyFinansowe(PrzeplywFinansowy $przeplywFinansowy)
    {
        $this->przeplywyFinansowe->removeElement($przeplywFinansowy);

        return $this;
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
