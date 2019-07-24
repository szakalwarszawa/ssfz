<?php

namespace Parp\SsfzBundle\Service;

use Doctrine\ORM\EntityManager;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaFunduszu;
use Parp\SsfzBundle\Repository\Slownik\WojewodztwoRepository;

/**
 * Serwis obsługujący operacje pomocnicze.
 *
 * Klasa robi różne rzeczy w różnych miescach z różnych przyczyn. Enjoy!
 */
class NarzedziaService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Repozytorium encji FormaPrawnaBeneficjenta
     *
     * @var FormaPrawnaBeneficjentaRepository
     */
    private $dictFormaRepo;

    /**
     * Repozytorium encji Wojewodztwo
     *
     * @var WojewodztwoRepository
     */
    private $dictWojRepo;

    /**
     * Repozytorium encji GospodarkaDzial
     *
     * @var GospodarkaDzialRepository
     */
    private $dictDzialRepo;

    /**
     * Konstruktor parametryczny
     *
     * @param EntityManager $entityManager
     * @param FormaPrawnaBeneficjentaRepository $dictFormaRepo repozytorium FormaPrawnaBeneficjentaRepository
     * @param WojewodztwoRepository $dictWojRepo repozytorium WojewodztwoRepository
     * @param GospodarkaDzialRepository $dictDzialRepo repozytorium GospodarkaDzialRepository
     *
     * @todo A gdzię są typehinty?!
     */
    public function __construct(EntityManager $entityManager, $dictFormaRepo, $dictWojRepo, $dictDzialRepo)
    {
        $this->entityManager = $entityManager;
        $this->dictFormaRepo = $dictFormaRepo;
        $this->dictWojRepo = $dictWojRepo;
        $this->dictDzialRepo = $dictDzialRepo;
    }

    /**
     * Zwraca słownik form prawnych beneficjenta
     *
     * @param  string $sort
     * @return array
     */
    public function getSlownikFormaPrawnaBeneficjenta($sort = null)
    {
        if (!$sort) {
            return $this->dictFormaRepo->findBy(array(), array('id' => 'ASC'));
        }

        return $this->dictFormaRepo->findBy(array(), array('nazwa' => $sort));
    }

    /**
     * Zwraca słownik form prawnych beneficjenta
     *
     * @param  string $sort
     *
     * @return array
     */
    public function getSlownikFormaPrawnaFunduszu($sort = null)
    {
        $repoFormaPrawna = $this->entityManager->getRepository(FormaPrawnaFunduszu::class);
        
        if (!$sort) {
            return $repoFormaPrawna->findBy(array(), array('id' => 'ASC'));
        }

        return $repoFormaPrawna->findBy(array(), array('nazwa' => $sort));
    }

    /**
     * Zwraca słownik województw
     *
     * @param  string $sort
     * @return array
     */
    public function getSlownikWojewodztwo($sort = null)
    {
        if (!$sort) {
            return $this->dictWojRepo->findBy(array(), array('id' => 'ASC'));
        }

        return $this->dictWojRepo->findBy(array(), array('nazwa' => $sort));
    }

    /**
     * Zwraca słownik działów gospodarki
     *
     * @param  string $sort
     * @return array
     */
    public function getSlownikGospodarkaDzial($sort = null)
    {
        if (!$sort) {
            return $this->dictDzialRepo->findBy(array(), array('id' => 'ASC'));
        }

        return $this->dictDzialRepo->findBy(array(), array('nazwa' => $sort));
    }

    /**
     * Zwraca repozytorium FormaPrawnaBeneficjentaRepository
     *
     * @return FormaPrawnaBeneficjentaRepository
     */
    public function getFormaPrawnaBeneficjentaRepo()
    {
        return $this->dictFormaRepo;
    }

    /**
     * Zwraca repozytorium GospodarkaDzialRepository
     *
     * @return GospodarkaDzialRepository
     */
    public function getGospodarkaDzialRepo()
    {
        return $this->dictDzialRepo;
    }

    /**
     * Zwraca repozytorium WojewodztwoRepository
     *
     * @return WojewodztwoRepository
     */
    public function getWojewodztwoRepo()
    {
        return $this->dictWojRepo;
    }
}
