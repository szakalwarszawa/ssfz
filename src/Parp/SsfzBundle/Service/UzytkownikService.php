<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Repository\UzytkownikRepository;
use Parp\SsfzBundle\Repository\RolaRepository;
use Parp\SsfzBundle\Entity\Rola;
use Parp\SsfzBundle\Entity\Uzytkownik;

/**
 * Dostęp do repozytorium użytkowników i ról.
 */
class UzytkownikService
{
    /**
     * @var UzytkownikRepository
     */
    private $uzytkownikRepository;

    /**
     * @var RolaRepository
     */
    private $rolaRepository;

    /**
     * Konstruktor
     *
     * @param UzytkownikRepository $uzytkownikRepository
     * @param RolaRepository $rolaRepository
     */
    public function __construct(UzytkownikRepository $uzytkownikRepository, RolaRepository $rolaRepository)
    {
        $this->uzytkownikRepository = $uzytkownikRepository;
        $this->rolaRepository = $rolaRepository;
    }

    /**
     * Zwraca repozytorium encji Uzytkownik
     *
     * @return UzytkownikRepository
     */
    public function getUzytkownikRepository()
    {
        return $this->uzytkownikRepository;
    }

    /**
     * Wyszukuje uzytkownika po kryteriach
     *
     * @param array $criteria
     *
     * @return Uzytkownik
     */
    public function findOneByCriteria(array $criteria = [])
    {
        return $this->uzytkownikRepository->findOneBy($criteria);
    }

    /**
     * Wyszukuje uzytkownika po kryteriach
     *
     * @param array $criteria
     *
     * @return Uzytkownik
     */
    public function findByCriteria(array $criteria = [])
    {
        return $this->uzytkownikRepository->findBy($criteria);
    }

    /**
     * Dodaje nowego użytkownika
     *
     * @param Uzytkownik $user
     *
     * @param Rola $role
     */
    public function persistNewUser(Uzytkownik $user, Rola $role)
    {
        $this->uzytkownikRepository->persistNewUser($user, $role);
    }

    /**
     * Aktywuje konto użytkownika
     *
     * @param Uzytkownik $user
     */
    public function activateUserAccount(Uzytkownik $user)
    {
        $this->uzytkownikRepository->activateUserAccount($user);
    }

    /**
     * Zapomniane hasło
     *
     * @param Uzytkownik $user
     */
    public function forgottenPassword(Uzytkownik $user)
    {
        $this->uzytkownikRepository->forgottenPassword($user);
    }

    /**
     * Nowe hasło
     *
     * @param Uzytkownik $user
     * @param string $password
     */
    public function newPassword(Uzytkownik $user, $password)
    {
        $this->uzytkownikRepository->newPassword($user, $password);
    }
}
