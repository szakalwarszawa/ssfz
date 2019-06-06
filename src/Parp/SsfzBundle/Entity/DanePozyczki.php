<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Sprawozdanie;

/**
 * Pożyczkach dla SPO WKP 1.2.1.
 *
 * @ORM\Table(name="sfz_dane_pozyczek")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\DanePozyczkiRepository")
 */
class DanePozyczki
{
    /**
     * Identyfikator.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Sprawozdanie, do którego przypisano dane pożyczki.
     *
     * @var Sprawozdanie
     * 
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Sprawozdanie")
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id", nullable=false)
     */
    protected $sprawozdanieId;

    protected $liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = 0;

    protected $liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = 0;

    protected $liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = 0;

    protected $liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = 0;

    protected $liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    protected $liczbaPozyczekObrotowwychDo10000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd300001Pln = 0;

    protected $liczbaPozyczekInwestycyjnychDo10000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd300001Pln = 0;

    protected $liczbaPozyczekInwestycyjnoObrotowychDo10000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd300001Pln = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaHandlowe = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaUslugowe = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaBudownicze = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaRolnicze = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaInne = 0;

    /**
     * Konstruktor.
     *
     * @param Sprawozdanie|null $sprawozdanie
     */
    public function __construct(?Sprawozdanie $sprawozdanie = null)
    {
        if (null !== $sprawozdanie) {
            $this->sprawozdanie = $sprawozdanie;
        }
    }

    /**
     * Zwraca reprezentację tekstową obiektu.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * Zwraca identyfikator.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Zwraca sprawozdanie, do którego przypisano dane pożyczki.
     *
     * @return Sprawozdanie
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }

    /**
     * Ustala sprawozdanie, do którego przypisano dane pożyczki.
     *
     * @param Sprawozdanie $sprawozdanie
     *
     * @return DanePozyczki
     */
    public function setSprawozdanie(Sprawozdanie $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }
}
