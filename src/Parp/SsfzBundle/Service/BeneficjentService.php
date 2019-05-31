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
class BeneficjentService
{
    /**
     * Repozytorium encji Beneficjent
     *
     * @var BeneficjentRepository
     */
    private $beneficjentRepository;

    /**
     * Repozytorium encji Umowa
     *
     * @var UmowaRepository
     */
    private $umowaRepository;

    /**
     * Repozytorium encji OsobaZatrudniona
     *
     * @var OsobaZatrudnionaRepository
     */
    private $osobaZatrudnionaRepository;

    /**
     * Konstruktor parametryczny
     *
     * @param BeneficjentRepository      $beneficjentRepository      reopzytorium BeneficjentRepository
     * @param UmowaRepository            $umowaRepository            repozytorium UmowaRepository
     * @param OsobaZatrudnionaRepository $osobaZatrudnionaRepository repozytorium OsobaZatrudnionaRepository
     */
    public function __construct($beneficjentRepository, $umowaRepository, $osobaZatrudnionaRepository)
    {
        $this->beneficjentRepository = $beneficjentRepository;
        $this->umowaRepository = $umowaRepository;
        $this->osobaZatrudnionaRepository = $osobaZatrudnionaRepository;
    }

    /**
     * Pobiera listę encji Umowa powiązanych z encją Beneficjent
     *
     * @param Beneficjent $beneficjent profil beneficjenta
     *
     * @return ArrayCollection
     */
    public function getBeneficjentUmowy(Beneficjent $beneficjent)
    {
        $result = new ArrayCollection();
        foreach ($beneficjent->getUmowy() as $umowa) {
            $result->add($umowa);
        }

        return $result;
    }

    /**
     * Pobiera listę encji OsobaZatrudniona powiązabych z encją Beneficjent
     *
     * @param Beneficjent $beneficjent profil beneficjenta
     *
     * @return ArrayCollection
     */
    public function getBeneficjentOsoby(Beneficjent $beneficjent)
    {
        $result = new ArrayCollection();
        foreach ($beneficjent->getOsobyZatrudnione() as $osoba) {
            $result->add($osoba);
        }

        return $result;
    }

    /**
     * Dodaje do profilu beneficjebta pustą umowę i/lub osobę zatrudnioną,
     * jeżeli nie ma innych powiązanych
     *
     * @param Beneficjent $beneficjent profil beneficjenta
     *
     * @return void
     */
    public function addUmowaOsobaIfEmpty(Beneficjent &$beneficjent)
    {
        if (0 === count($beneficjent->getUmowy())) {
            $beneficjent->addUmowa(new Umowa());
        }
        if (0 === count($beneficjent->getOsobyZatrudnione())) {
            $beneficjent->addOsobaZatrudniona(new OsobaZatrudniona());
        }
    }

    /**
     * Dodaje nową encję Beneficjent powiązaną z podaną w parametrze encją
     * Uzytkownik
     *
     * @param Uzytkownik $uzytkownik zalogowany użytkownik
     *
     * @return Beneficjent
     */
    public function addBeneficjent(Uzytkownik $uzytkownik)
    {
        return $this->beneficjentRepository->addNewBeneficjent($uzytkownik);
    }

    /**
     * Aktualizuje encję Beneficjent
     *
     * @param Beneficjent     $beneficjent   profil beneficjenta
     * @param ArrayCollection $originalUmowy lista umów przed zmianą
     * @param ArrayCollection $originalOsoby lista osób przed zmianą
     *
     * @return void
     */
    public function updateBeneficjent(Beneficjent &$beneficjent, ArrayCollection $originalUmowy, ArrayCollection $originalOsoby)
    {
        $this->beneficjentRepository->updateBeneficjent($beneficjent, $originalUmowy, $originalOsoby);
    }

    /**
     * Zwraca repozytorium BeneficjentRepository
     *
     * @return BeneficjentRepository
     */
    public function getBeneficjentRepository()
    {
        return $this->beneficjentRepository;
    }

    /**
     * Zwraca repozytorium UmowaRepository
     *
     * @return UmowaRepository
     */
    public function getUmowaRepository()
    {
        return $this->umowaRepository;
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
