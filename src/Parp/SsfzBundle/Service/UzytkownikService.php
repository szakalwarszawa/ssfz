<?php
namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Repository\UzytkownikRepository;
use Parp\SsfzBundle\Repository\RolaRepository;

/**
 * Dostęp do repozytorium użytkowników i ról.
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
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
     * @param RolaRepository       $rolaRepository
     */
    public function __construct($uzytkownikRepository, $rolaRepository)
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
     * Zwraca repozytorium encji Rola
     * 
     * @return UzytkownikRepository
     */
    public function getRolaRepository()
    {
        return $this->rolaRepository;
    }
}
