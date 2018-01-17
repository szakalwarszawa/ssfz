<?php
/**
 * Serwis obsługujący operacje pomocnicze
 *
 * @category Service
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
namespace Parp\SsfzBundle\Service;

/**
 * Serwis obsługujący operacje pomocnicze
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class DatatableParpService
{

    /**
     * Repozytorium encji OkresyKonfiguracja
     * 
     * @var OkresyKonfiguracjaRepository
     */
    private $okresyKonfiguracjaRepo;

    /**
     * Konstruktor parametryczny
     * 
     * @param OkresyKonfiguracjaRepository $okresyKonfiguracjaRepo repozytorium OkresyKonfiguracjaRepository
     */
    public function __construct($okresyKonfiguracjaRepo)
    {
        $this->okresyKonfiguracjaRepo = $okresyKonfiguracjaRepo;
    }

    /**
     * Zwraca konfigurację tabeli Parp
     * 
     * @return array
     */
    public function getParpKonfiguracja()
    {
        return $this->okresyKonfiguracjaRepo->findBy(array(), array('rok' => 'ASC'));
    }

    /**
     * Zwraca tablicę rendererów tabeli parp
     * 
     * @param array $config
     * 
     * @return array
     */
    public function getDatatableParpRenderers($config)
    {
        $renderers[1]['view'] = 'SsfzBundle:Parp:_beneficjentNazwa.html.twig';
        $renderers[2]['view'] = 'SsfzBundle:Parp:_umowaNumer.html.twig';
        $idx = 3;
        foreach ($config as $cfg) {
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:_okresStatus.html.twig';
            $idx++;
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:_okresStatus.html.twig';
            $idx++;
        }

        return $renderers;
    }

    /**
     * Zwraca pola tabeli parp
     * 
     * @param array $config
     * 
     * @return array
     */
    public function getDatatableParpFields($config)
    {
        $fields['BeneId'] = 'b.id';
        $fields['Nazwa'] = 'b.nazwa';
        $fields['Numer umowy'] = 'u.numer';
        $idx = 1;
        foreach ($config as $cfg) {
            $fields['1 - 6 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
            $idx++;
            $fields['7 - 12 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
            $idx++;
        }
        $fields['_identifier_'] = 'u.id';

        return $fields;
    }

    /**
     * Ustawia joiny w podanej w parametrze datatable
     * 
     * @param type  $datatable
     * @param array $config
     * 
     * @return datatable
     */
    public function datatableParpAddJoins($datatable, $config)
    {
        $datatable->addJoin('u.beneficjent', 'b', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN); //, \Doctrine\ORM\Query\Expr\Join::WITH, 'b.id = u.beneficjentId');  
        $idx = 1;
        foreach ($config as $cfg) {
            $datatable->addJoin('u.sprawozdania', 's' . $idx, \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = s' . $idx . '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.okresId = 0 and s' . $idx . '.czyNajnowsza = 1');
            $idx++;
            $datatable->addJoin('u.sprawozdania', 's' . $idx, \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = s' . $idx . '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.okresId = 1 and s' . $idx . '.czyNajnowsza = 1');
            $idx++;
        }

        return $datatable;
    }

    /**
     * Zwraca datatable parp
     * 
     * @param Controller $parentObj
     * 
     * @return datatable
     */
    public function datatableParp($parentObj)
    {
        $config = $this->getParpKonfiguracja();
        $datatable = $parentObj->get('datatable')
            ->setDatatableId('dta-umowy')
            ->setEntity('SsfzBundle:Umowa', 'u')
            ->setFields($this->getDatatableParpFields($config));

        $datatable = $this->datatableParpAddJoins($datatable, $config);
        $datatable
            ->setRenderers($this->getDatatableParpRenderers($config))
            ->setSearch(true)
            ->setOrder('b.nazwa', 'asc')
            ->setOrder('u.numer', 'asc');

        return $datatable;
    }
}
