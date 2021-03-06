<?php

namespace Parp\SsfzBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\Query\Expr\Join;
use Waldo\DatatableBundle\Util\Datatable;
use Parp\SsfzBundle\Service\WyborProgramuService;
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
     * @var Session
     */
    private $wyborProgramu;

    /**
     * @var Datatable
     */
    private $dataTable;

    /**
     * Konstruktor.
     *
     * @param OkresyKonfiguracjaRepository $konfiguracjaOkresow
     * @param WyborProgramuService $wyborProgramu
     * @param Datatable $dataTable
     */
    public function __construct(
        OkresyKonfiguracjaRepository $konfiguracjaOkresow,
        WyborProgramuService $wyborProgramu,
        Datatable $dataTable
    ) {
        $this->okresyKonfiguracjaRepo = $konfiguracjaOkresow;
        $this->wyborProgramu = $wyborProgramu;
        $this->dataTable = $dataTable;
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
        $renderers[1]['view'] = 'SsfzBundle:Parp:beneficjent_nazwa.html.twig';
        $renderers[2]['view'] = $program->czyJestPortfelSpolek()
            ? 'SsfzBundle:Parp:umowa_numer.html.twig'
            : 'SsfzBundle:Parp:umowa_numer.spo.html.twig'
        ;

        $idx = 3;
        foreach ($config as $cfg) {
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:okres_status.html.twig';
            $idx++;
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:okres_status.html.twig';
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
        $czestotliwoscRoczna = $program
            ->getOkresySprawozdawcze()
            ->first()
            ->jestRoczny()
        ;
        
        $fields['BeneId'] = 'b.id';
        $fields['Nazwa'] = 'b.nazwa';
        $fields['Numer umowy'] = 'u.numer';
        $idx = 1;
        foreach ($config as $cfg) {
            if ($czestotliwoscRoczna) {
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
     * @param array $config
     * @param Program $program
     */
    public function datatableParpAddJoins($config, Program $program)
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

        $this
            ->dataTable
            ->addJoin('u.beneficjent', 'b', Join::INNER_JOIN)
            ->addJoin('b.program', 'p', Join::INNER_JOIN)
            ->setWhere('p.id = ' . ((int) $program->getId()))
        ;
        
        $doctrineQueryBuilder = $this
            ->dataTable
            ->getQueryBuilder()
            ->getDoctrineQueryBuilder()
        ;

        $okresy = $program->getOkresySprawozdawcze();

        $params = [];
        foreach ($okresy as $key => $okres) {
            $params['okres' . $key] = $okres;
        }

        $idx = 1;
        foreach ($config as $cfg) {
            foreach ($okresy as $key => $okres) {
                $this
                    ->dataTable
                    // Wydaje się, że użycie w WITH identyfikatora umowy jest zbędne, gdyż złączenie to gwarantują
                    // INNER_JOIN-y powyżej.
                    // Pozbywając się tej zależności, można pozbyć się redundancji informacji o umowie w encjach.
                    // ->addJoin('u.' . $nazwaParametru, 's' . $idx, Join::LEFT_JOIN, Join::WITH, 'u.id = s' . $idx .
                    // '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.czyNajnowsza = 1 and
                    // s' . $idx . '.okres = :okres' . $key)
                    ->addJoin(
                        'u.' . $nazwaParametru,
                        's' . $idx,
                        Join::LEFT_JOIN,
                        Join::WITH,
                        's' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.czyNajnowsza = 1 and s'
                        . $idx . '.okres = :okres' . $key
                    );
                $idx++;
            }
        }
        
        $doctrineQueryBuilder->setParameters($params);
    }

    /**
     * @return Datatable
     */
    public function datatableParp()
    {
        $config = $this->getParpKonfiguracja();
        $program = $this->wyborProgramu->getProgram();
        $fields = $this->getDatatableParpFields($config, $program);

        $this
            ->dataTable
            ->setDatatableId('dta-umowy')
            ->setEntity('SsfzBundle:Umowa', 'u')
            ->setFields($fields)
        ;

        $this->datatableParpAddJoins($config, $program);

        $this
            ->dataTable
            ->setRenderers($this->getDatatableParpRenderers($config, $program))
            ->setSearch(true)
            ->setOrder('b.nazwa', 'asc')
            ->setOrder('u.numer', 'asc')
        ;

        return $this->dataTable;
    }
}
