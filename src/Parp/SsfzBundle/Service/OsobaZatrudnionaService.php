<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\OsobaZatrudniona;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Serwis obsługujący operacje na profilu beneficjenta
 */
class OsobaZatrudnionaService
{

    /**
     * Repozytorium encji OsobaZatrudniona
     *
     * @var OsobaZatrudnionaRepository
     */
    private $osobaZatrudnionaRepository;

    /**
     * Konstruktor parametryczny
     *
     * @param OsobaZatrudnionaRepository $osobaZatrudnionaRepository repozytorium OsobaZatrudnionaRepository
     */
    public function __construct($osobaZatrudnionaRepository)
    {
        $this->osobaZatrudnionaRepository = $osobaZatrudnionaRepository;
    }

    /**
     * Zwraca repozytorium OsobaZatrudnionaRepository
     *
     * @return OsobaZatrudnionaRepository
     */
    public function getOsobaZatrudnionaRepository()
    {
        return $this->osobaZatrudnionaRepository;
    }
}
