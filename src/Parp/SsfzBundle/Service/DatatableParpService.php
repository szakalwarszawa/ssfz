<?php

namespace Parp\SsfzBundle\Service;

use Doctrine\ORM\Query\Expr\Join;
use Parp\SsfzBundle\Repository\OkresyKonfiguracjaRepository;
use Parp\SsfzBundle\Entity\Slownik\Program;

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
     *
     */
    public function __construct(OkresyKonfiguracjaRepository $okresyKonfiguracjaRepo)
    {
        $this->okresyKonfiguracjaRepo = $okresyKonfiguracjaRepo;
    }

    /**
     * Zwraca aktualnego użytkownika aplikacji.
     *
     * @return Uzytkownik|null
     */
    public function getUser()
    {
        $user = null;
        $storage = $this->tokenStorage;
        if (null !== $storage) {
            $token = $storage->getToken();
            if (null !== $token) {
                $user = $token->getUser();
            }
        }

        return $user;
    }

    /**
     * Zwraca ID aktualnie przeglądanego programu.
     *
     * @return int
     */
    public function getAktywnyProgramId()
    {
        $program = $this->getUser()->getAktywnyProgram();
        
        return (null !== $program)
            ? (int) $program->getId()
            : Program::FUNDUSZ_ZALAZKOWY_POIG_31
        ;
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
     * @param object $datatable
     * @param array $config
     * @param int $programId
     *
     * @return datatable
     */
    public function datatableParpAddJoins($datatable, $config, $programId)
    {
        switch ($programId) {
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
            ->setWhere('p.id = '. ((int) $programId))
        ;

        $idx = 1;
        foreach ($config as $cfg) {
            $datatable->addJoin('u.' . $nazwaParametru, 's' . $idx, Join::LEFT_JOIN, Join::WITH, 'u.id = s' . $idx . '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.okresId = 0 and s' . $idx . '.czyNajnowsza = 1');
            $idx++;
            $datatable->addJoin('u.' . $nazwaParametru, 's' . $idx, Join::LEFT_JOIN, Join::WITH, 'u.id = s' . $idx . '.umowaId and s' . $idx . '.rok = ' . $cfg->getRok() . ' and s' . $idx . '.okresId = 1 and s' . $idx . '.czyNajnowsza = 1');
            $idx++;
        }

        return $datatable;
    }

    /**
     * Zwraca datatable parp
     *
     * @param Controller $parentObj
     * @param int $programId
     *
     * @return object
     */
    public function datatableParp($parentObj, $programId)
    {
        $config = $this->getParpKonfiguracja();
        $datatable = $parentObj
            ->get('datatable')
            ->setDatatableId('dta-umowy')
            ->setEntity('SsfzBundle:Umowa', 'u')
            ->setFields($this->getDatatableParpFields($config))
        ;
        
        $datatable = $this->datatableParpAddJoins($datatable, $config, $programId);
        $datatable
            ->setRenderers($this->getDatatableParpRenderers($config))
            ->setSearch(true)
            ->setOrder('b.nazwa', 'asc')
            ->setOrder('u.numer', 'asc')
        ;

        return $datatable;
    }
}
