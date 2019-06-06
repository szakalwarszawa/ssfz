<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Konstruktor.
     */
    public function __construct(?int $id = null)
    {
        // Tymczasowe, żeby odizolować się od bazy danych.
        if ($id !== null) {
            $this->id = $id;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
