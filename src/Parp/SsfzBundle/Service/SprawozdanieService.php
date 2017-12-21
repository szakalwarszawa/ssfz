<?php
namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Repository\SprawozdanieRepository;

/**
 * Dostęp do repozytorium sprawozdań
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class SprawozdanieService
{

    /**
     * @var SprawozdanieRepository
     */
    private $uzytkownikRepository;

    /**
     * Konstruktor
     * 
     * @param SprawozdanieRepository $sprawozdanieRepository
     */
    public function __construct($sprawozdanieRepository)
    {
        $this->sprawozdanieRepository = $sprawozdanieRepository;
    }

    /**
     * Zwraca repozytorium encji Sprawozdanie
     * 
     * @return SprawozdanieRepository
     */
    public function getSprawozdanieRepository()
    {
        return $this->sprawozdanieRepository;
    }
}
