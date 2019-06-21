<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Helper\MoneyHelper;

/**
 * Dane poręczeń do sprawozdania dla SPO WKP 1.2.2.
 *
 * Uwaga!
 * Dane w formacie decimal (po stronie bazy danych) są przez Doctrine mapowane na typ PHP "string",
 * a nie na "float". Unika się w ten sposób utraty precyzji.
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/2.9/reference/types.html#decimal
 *
 * @ORM\Table(name="sfz_dane_poreczen")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\DanePoreczenRepository")
 *
 * @see bin/phpunit --configuration ./tests/phpunit.xml --no-coverage --bootstrap ./vendor/autoload.php tests/Parp/SsfzBundle/Entity/DanePoreczenTest
 */
class DanePoreczen
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
     * @var SprawozdaniePoreczeniowe
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe")
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id", nullable=false)
     */
    protected $sprawozdanie;



    /**
     * Liczba współpracujących banków.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wspolpracujacych_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba współpracujących banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWspolpracujacychBankow = 0;

    /**
     * Liczba współpracujących funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wspolpracujacych_funduszy_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba współpracujących funduszy pożyczkowych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWspolpracujacychFunduszyPozyczkowych = 0;

    /**
     * Liczba innych podmiotów współpracujących.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_innych_podmiotow_wspolpracujacych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba innych podmiotów współpracujących.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaInnychPodmiotowWspolpracujacych = 0;

    /**
     * Konstruktor.
     *
     * @param SprawozdaniePoreczeniowe|null $sprawozdanie
     */
    public function __construct(?SprawozdaniePoreczeniowe $sprawozdanie = null)
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
     * Zwraca iwartość dentyfikatora.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Zwraca wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @return SprawozdaniePozyczkowe
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }

    /**
     * Ustala wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @param SprawozdaniePozyczkowe $sprawozdanie
     *
     * @return DanePozyczek
     */
    public function setSprawozdanie(SprawozdaniePozyczkowe $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Zwraca wartość liczby współpracujących banków.
     *
     * @return int
     */
    public function getLiczbaWspolpracujacychBankow()
    {
        return $this->liczbaWspolpracujacychBankow;
    }

    /**
     * Ustala wartość liczby współpracujących banków.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaWspolpracujacychBankow(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaWspolpracujacychBankow = abs($liczbaWspolpracujacych);

        return $this;
    }

    /**
     * Zwraca wartość liczby współpracujących funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaWspolpracujacychFunduszyPozyczkowych()
    {
        return $this->liczbaWspolpracujacychFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby współpracujących funduszy pożyczkowych.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaWspolpracujacychFunduszyPozyczkowych(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaWspolpracujacychFunduszyPozyczkowych = abs($liczbaWspolpracujacych);

        return $this;
    }

    /**
     * Zwraca wartość liczby innych podmiotów współpracujących.
     *
     * @return int
     */
    public function getLiczbaInnychPodmiotowWspolpracujacych()
    {
        return $this->liczbaInnychPodmiotowWspolpracujacych;
    }

    /**
     * Ustala wartość liczby innych podmiotów współpracujących.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaInnychPodmiotowWspolpracujacych(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaInnychPodmiotowWspolpracujacych = abs($liczbaWspolpracujacych);

        return $this;
    }
}
