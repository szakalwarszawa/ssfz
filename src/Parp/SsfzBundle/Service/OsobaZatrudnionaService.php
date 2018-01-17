<?php
/**
 * Serwis obsługujący operacje na profilu beneficjenta
 *
 * @category Service
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\OsobaZatrudniona;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Serwis obsługujący operacje na profilu beneficjenta
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
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
