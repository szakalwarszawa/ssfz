<?php

namespace Parp\SsfzBundle\Service;

use Doctrine\ORM\Query\Expr\Join;
use Parp\SsfzBundle\Repository\OkresyKonfiguracjaRepository;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * Serwis obsługujący operacje pomocnicze
 */
class DatatableParpService
{
    /**
     * Repozytorium encji OkresyKonfiguracja
     *
     * @var OkresyKonfiguracjaRepository
     */
    protected $okresyKonfiguracjaRepo;

    /**
     * Konstruktor parametryczny
     *
     * @param OkresyKonfiguracjaRepository $okresyKonfiguracjaRepo repozytorium OkresyKonfiguracjaRepository
     */
    public function __construct(OkresyKonfiguracjaRepository $okresyKonfiguracjaRepo)
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
        return $this->okresyKonfiguracjaRepo->findBy([], ['rok' => 'ASC']);
    }

    /**
     * Zwraca tablicę rendererów tabeli parp
     *
     * @param array $config
     * @param Program $program
     *
     * @return array
     */
    public function getDatatableParpRenderers($config, Program $program)
    {
        $renderers[1]['view'] = 'SsfzBundle:Parp:_beneficjentNazwa.html.twig';
        $renderers[2]['view'] = $program->czyJestPortfelSpolek()
            ? 'SsfzBundle:Parp:_umowaNumer.html.twig'
            : 'SsfzBundle:Parp:_umowaNumer.spo.html.twig'
        ;

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
     * @param Program $program
     *
     * @return array
     */
    public function getDatatableParpFields($config, Program $program)
    {
        $czestotliwosc = $program->getCzestotliwoscSprawozdan();
        
        $fields['BeneId'] = 'b.id';
        $fields['Nazwa'] = 'b.nazwa';
        $fields['Numer umowy'] = 'u.numer';
        $idx = 1;
        foreach ($config as $cfg) {
            if ($czestotliwosc->czyRoczna()) {
                $fields[$cfg->getRok()] = 's' . $idx . '.idStatus';
                $idx++;
            } else {
                $fields['1 - 6 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
                $idx++;
                $fields['7 - 12 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
                $idx++;
            }
        }
        $fields['_identifier_'] = 'u.id';

        return $fields;
    }

    /**
     * Ustawia joiny w podanej w parametrze datatable
     *
     * @param ?????????????object?? $datatable
     * @param array $config
     * @param Program $program
     *
     * @return datatable
     */
    public function datatableParpAddJoins($datatable, $config, Program $program)
    {
        switch ($program->getId()) {
            case Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121:
                $nazwaParametru = 'sprawozdaniaPozyczkowe';
                break;

            case Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122:
                $nazwaParametru = 'sprawozdaniaPoreczeniowe';
                break;

            case Program::FUNDUSZ_ZALAZKOWY_POIG_31:
            default:
                $nazwaParametru = 'sprawozdaniaZalazkowe';
                break;
        }
        
        $datatable
            ->addJoin('u.beneficjent', 'b', Join::INNER_JOIN)
            ->addJoin('b.program', 'p', Join::INNER_JOIN)
            ->setWhere('p.id = '. ((int) $program->getId()))
        ;
        
        $doctrineQueryBuilder = $datatable
            ->getQueryBuilder()
            ->getDoctrineQueryBuilder()
        ;
        
        $entityManager = $doctrineQueryBuilder->getEntityManager();
        
        $okresy = $entityManager
            ->getRepository(OkresSprawozdawczy::class)
            ->findBy(['czestotliwoscSprawozdan' => $program->getCzestotliwoscSprawozdan()])
        ;
        
        $params = [];
        foreach ($okresy as $key => $okres) {
            $params['okres'.$key] = $okres;
        }

        $idx = 1;
        foreach ($config as $cfg) {
            foreach ($okresy as $key => $okres) {
                $datatable->addJoin('u.' . $nazwaParametru, 's' . $idx, Join::LEFT_JOIN, Join::WITH, 'u.id = s' . $idx . '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.czyNajnowsza = 1 and s' . $idx . '.okres = :okres' . $key);
                $idx++;
            }
        }
        
        $doctrineQueryBuilder->setParameters($params);

        return $datatable;
    }

    /**
     * Zwraca datatable parp
     *
     * @param Controller $parentObj
     * @param Program $program
     *
     * @return object
     */
    public function datatableParp($parentObj, Program $program)
    {
        $config = $this->getParpKonfiguracja();
        $datatable = $parentObj
            ->get('datatable')
            ->setDatatableId('dta-umowy')
            ->setEntity('SsfzBundle:Umowa', 'u')
            ->setFields($this->getDatatableParpFields($config, $program))
        ;
        
        $datatable = $this->datatableParpAddJoins($datatable, $config, $program);
        $datatable
            ->setRenderers($this->getDatatableParpRenderers($config, $program))
            ->setSearch(true)
            ->setOrder('b.nazwa', 'asc')
            ->setOrder('u.numer', 'asc')
        ;

        return $datatable;
    }
}
