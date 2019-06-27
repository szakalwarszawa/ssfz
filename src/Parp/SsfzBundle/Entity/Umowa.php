<?php

namespace Parp\SsfzBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Parp\SsfzBundle\Exception\KomunikatDlaBeneficjentaException;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Slownik\Program;

/**
 * Umowa
 *
 * @ORM\Table(name="sfz_umowa")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\UmowaRepository")
 */
class Umowa
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
     * @var int
     *
     * @ORM\Column(name="beneficjent_id", type="integer")
     */
    protected $beneficjentId;

    /**
     * @ORM\ManyToOne(targetEntity="Beneficjent", inversedBy="umowy")
     * @ORM\JoinColumn(name="beneficjent_id", referencedColumnName="id")
     */
    protected $beneficjent;

    /**
     * @var string
     *
     * @ORM\Column(name="numer", type="string", length=26)
     */
    protected $numer;

    /**
     * Encje Spolka powiazane z umową - spółki składające się na portfel
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Spolka", mappedBy="umowa", cascade={"persist"})
     */
    protected $spolki;

    /**
     * Sprawozdania zalążkowe.
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Sprawozdanie", mappedBy="umowa", cascade={"persist"})
     */
    protected $sprawozdaniaZalazkowe;

    /**
     * Sprawozdania pożyczkowe.
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="SprawozdaniePozyczkowe", mappedBy="umowa", cascade={"persist"})
     */
    protected $sprawozdaniaPozyczkowe;

    /**
     * Sprawozdania poręczeniowe.
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="SprawozdaniePoreczeniowe", mappedBy="umowa", cascade={"persist"})
     */
    protected $sprawozdaniaPoreczeniowe;

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->spolki = new ArrayCollection();
        $this->sprawozdania = new ArrayCollection();
        $this->sprawozdaniaZalazkowe = new ArrayCollection();
        $this->sprawozdaniaPozyczkowe = new ArrayCollection();
        $this->sprawozdaniaPoreczeniowe = new ArrayCollection();
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
     * Set beneficjentId
     *
     * @param  int $beneficjentId
     *
     * @return Umowa
     */
    public function setBeneficjentId($beneficjentId)
    {
        $this->beneficjentId = $beneficjentId;

        return $this;
    }

    /**
     * Get beneficjentId
     *
     * @return int
     */
    public function getBeneficjentId()
    {
        return $this->beneficjentId;
    }

    /**
     * Set beneficjent
     *
     * @param Beneficjent $beneficjent
     *
     * @return Umowa
     */
    public function setBeneficjent($beneficjent)
    {
        $this->beneficjent = $beneficjent;

        return $this;
    }

    /**
     * Get beneficjent
     *
     * @return Beneficjent
     */
    public function getBeneficjent()
    {
        return $this->beneficjent;
    }

    /**
     * Set numer
     *
     * @param string $numer
     *
     * @return Umowa
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return string
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * Set spolki
     *
     * @param Collection $spolki
     *
     * @return Umowa
     */
    public function setSpolki($spolki)
    {
        $this->spolki = $spolki;

        return $this;
    }

    /**
     * Get spolki
     *
     * @return Collection
     */
    public function getSpolki()
    {
        return $this->spolki;
    }

    /**
     * Dodaje spółkę do portfela spółek umowy
     *
     * @param Spolka $spolka
     */
    public function addSpolka(Spolka $spolka)
    {
        $spolka->setUmowa($this);
        $this->spolki->add($spolka);
    }

    /**
     * Set sprawozdania
     *
     * @param Collection $sprawozdania
     *
     * @return Umowa
     */
    public function setSprawozdania($sprawozdania)
    {
        $programId = (int) $this->beneficjent->getProgram()->getId();
        
        switch ($programId) {
            case Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121:
                $this->sprawozdaniaPozyczkowe = $sprawozdania;
                break;

            case Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122:
                $this->sprawozdaniaPoreczeniowe = $sprawozdania;
                break;

            case Program::FUNDUSZ_ZALAZKOWY_POIG_31:
            default:
                $this->sprawozdaniaZalazkowe = $sprawozdania;
                break;
        }

        return $this;
    }

    /**
     * Get sprawozdania
     *
     * @return Collection
     */
    public function getSprawozdania()
    {
        $programId = (int) $this->beneficjent->getProgram()->getId();
        
        switch ($programId) {
            case Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121:
                return $this->sprawozdaniaPozyczkowe;
                break;
            case Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122:
                return $this->sprawozdaniaPoreczeniowe;
                break;
            case Program::FUNDUSZ_ZALAZKOWY_POIG_31:
            default:
                return $this->sprawozdaniaZalazkowe;
                break;
        }
    }

    /**
     * Add spolki
     *
     * @param Spolka $spolki
     *
     * @return Umowa
     */
    public function addSpolki(Spolka $spolki)
    {
        $this->spolki[] = $spolki;

        return $this;
    }

    /**
     * Remove spolki
     *
     * @param Spolka $spolki
     */
    public function removeSpolki(Spolka $spolki)
    {
        $this->spolki->removeElement($spolki);
    }

    /**
     * Add sprawozdaniaZalazkowe
     *
     * @param Sprawozdanie $sprawozdaniaZalazkowe
     *
     * @return Umowa
     */
    public function addSprawozdaniaZalazkowe(Sprawozdanie $sprawozdaniaZalazkowe)
    {
        $this->sprawozdaniaZalazkowe[] = $sprawozdaniaZalazkowe;

        return $this;
    }

    /**
     * Remove sprawozdaniaZalazkowe
     *
     * @param Sprawozdanie $sprawozdaniaZalazkowe
     */
    public function removeSprawozdaniaZalazkowe(Sprawozdanie $sprawozdaniaZalazkowe)
    {
        $this->sprawozdaniaZalazkowe->removeElement($sprawozdaniaZalazkowe);
    }

    /**
     * Get sprawozdaniaZalazkowe
     *
     * @return Collection
     */
    public function getSprawozdaniaZalazkowe()
    {
        return $this->sprawozdaniaZalazkowe;
    }

    /**
     * Add sprawozdaniaPozyczkowe
     *
     * @param SprawozdaniePozyczkowe $sprawozdaniaPozyczkowe
     *
     * @return Umowa
     */
    public function addSprawozdaniaPozyczkowe(SprawozdaniePozyczkowe $sprawozdaniaPozyczkowe)
    {
        $this->sprawozdaniaPozyczkowe[] = $sprawozdaniaPozyczkowe;

        return $this;
    }

    /**
     * Remove sprawozdaniaPozyczkowe
     *
     * @param SprawozdaniePozyczkowe $sprawozdaniaPozyczkowe
     */
    public function removeSprawozdaniaPozyczkowe(SprawozdaniePozyczkowe $sprawozdaniaPozyczkowe)
    {
        $this->sprawozdaniaPozyczkowe->removeElement($sprawozdaniaPozyczkowe);
    }

    /**
     * Get sprawozdaniaPozyczkowe
     *
     * @return Collection
     */
    public function getSprawozdaniaPozyczkowe()
    {
        return $this->sprawozdaniaPozyczkowe;
    }

    /**
     * Add sprawozdaniaPoreczeniowe
     *
     * @param SprawozdaniePoreczeniowe $sprawozdaniaPoreczeniowe
     *
     * @return Umowa
     */
    public function addSprawozdaniaPoreczeniowe(SprawozdaniePoreczeniowe $sprawozdaniaPoreczeniowe)
    {
        $this->sprawozdaniaPoreczeniowe[] = $sprawozdaniaPoreczeniowe;

        return $this;
    }

    /**
     * Remove sprawozdaniaPoreczeniowe
     *
     * @param SprawozdaniePoreczeniowe $sprawozdaniaPoreczeniowe
     */
    public function removeSprawozdaniaPoreczeniowe(SprawozdaniePoreczeniowe $sprawozdaniaPoreczeniowe)
    {
        $this->sprawozdaniaPoreczeniowe->removeElement($sprawozdaniaPoreczeniowe);
    }

    /**
     * Get sprawozdaniaPoreczeniowe
     *
     * @return Collection
     */
    public function getSprawozdaniaPoreczeniowe()
    {
        return $this->sprawozdaniaPoreczeniowe;
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do edycji.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @throws KomunikatDlaBeneficjentaException
     */
    public function sprawdzCzyUzytkownikMozeWyswietlac(Uzytkownik $uzytkownik)
    {
        $idWlasciciela = (int) $this->beneficjent->getUzytkownik()->getId();

        if ((int) $uzytkownik->getId() !== $idWlasciciela) {
            throw new KomunikatDlaBeneficjentaException('Umowa należy do innego użytkownika.');
        }
    }
}
