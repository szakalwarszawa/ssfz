<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity\Slownik;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * OkresSprawozdawczy
 *
 * @ORM\Table(name="slownik_okresow_sprawozdawczych")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\Slownik\OkresSprawozdawcyRepository")
 */
class OkresSprawozdawczy
{
    const STYCZEN_GRUDZIEN = 1;
    const STYCZEN_CZERWIEC = 2;
    const LIPIEC_GRUDZIEN = 3;

    /**
     * ID okresu.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Nazwa okresu.
     *
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=64, unique=true)
     */
    protected $nazwa;

    /**
     * miesiąc, od którego obowiązuje.
     *
     * @var int
     *
     * @ORM\Column
     *     name="miesiacPoczatkowy",
     *     type="smallint",
     *     nullable=false,
     *     options={
     *         "comment":"Miesiąc, od którego obowiązuje."
     *     }
     * )
     */
    protected $miesiacPoczatkowy;

    /**
     * Miesiąc, do którego obowiązuje.
     *
     * @var int
     *
     * @ORM\Column
     *     name="miesiacKoncowy",
     *     type="smallint",
     *     nullable=false,
     *     options={
     *         "comment":"Miesiąc, do którego obowiązuje."
     *     }
     * )
     */
    protected $miesiacKoncowy;

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
     * Konstruktor.
     *
     * @param string|null $nazwa
     * @param int|null $miesiacPoczatkowy
     * @param int|null $miesiacKoncowy
     */
    public function __construct(?string $nazwa = null, ?int $miesiacPoczatkowy = null, ?int $miesiacKoncowy = null)
    {
        if (null !== $nazwa) {
            $this->nazwa = trim((string) $nazwa);
        }

        if (null !== $miesiacPoczatkowy) {
            $this->miesiacPoczatkowy = $miesiacPoczatkowy;
        }

        if (null !== $miesiacKoncowy) {
            $this->miesiacKoncowy = $miesiacKoncowy;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNazwa();
    }

    /**
     * Zwraca nazwę okresu sprawozdawczego.
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Ustala nazwę okresu sprawozdawczego.
     *
     * @param string $nazwa
     *
     * @return OkresSprawozdawczy
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        
        return $this;
    }

    /**
     * Zwraca wartość miesiąca, od którego obowiązuje.
     *
     * @return int
     */
    public function getMiesiacPoczatkowy(): int
    {
        return $this->miesiacPoczatkowy;
    }

    /**
     * Ustala wartość miesiąca, od którego obowiązuje.
     *
     * @param int $miesiacPoczatkowy
     *
     * @return OkresSprawozdawczy
     */
    public function setMiesiacPoczatkowy(int $miesiacPoczatkowy)
    {
        $this->miesiacPoczatkowy = $miesiacPoczatkowy;

        return $this;
    }

    /**
     * Zwraca wartość miesiąca, do którego obowiązuje.
     *
     * @return int
     */
    public function getMiesiacKoncowy(): int
    {
        return $this->miesiacKoncowy;
    }

    /**
     * Ustala wartość miesiąca, do którego obowiązuje.
     *
     * @param int $miesiacKoncowy
     *
     * @return OkresSprawozdawczy
     */
    public function setMiesiacKoncowy(int $miesiacKoncowy)
    {
        $this->miesiacKoncowy = $miesiacKoncowy;

        return $this;
    }

    /**
     * Określa czy okres sprawozdawczy jest kwartalny.
     *
     * @return boolean
     */
    public function jestKwartalny(): bool
    {
        return $this->getMonths() === 3;
    }

    /**
     * Określa czy okres sprawozdawczy jest roczny.
     *
     * @return boolean
     */
    public function jestPolroczny(): bool
    {
        return $this->getMonths() === 6;
    }

    /**
     * Określa czy okres sprawozdawczy jest półroczny.
     *
     * @return boolean
     */
    public function jestRoczny(): bool
    {
        return $this->getMonths() === 12;
    }

    private function getMonths(): int
    {
        $diff = $this->miesiacKoncowy - $this->miesiacPoczatkowy;
        $diff++;

        return $diff;
    }
}
