<?php

namespace Parp\SsfzBundle\Service;

/**
 * Serwis obsługujący grid osób zatrudnionych
 */
class DatatableOsobyService
{
    /**
     * Zwraca pola tabeli osób zatrudnionych
     *
     * @return array
     */
    public function getDatatableOsobyFields()
    {
        return [
            'Imię'                   => 'o.imie',
            'Imię i nazwisko'        => 'o.nazwisko',
            'Rodzaj umowy'           => 'o.umowaRodzaj',
            'Data zawarcia umowy'    => 'o.umowaData',
            'Data rozpoczęcia pracy' => 'o.rozpoczecieData',
            'Stanowisko'             => 'o.stanowisko',
            'Wymiar etatu'           => 'o.wymiar',
            '_identifier_'           => 'o.id'
        ];
    }

    /**
     * Zwraca tablicę rendererów tabeli osób zatrudnionych
     *
     * @return array
     */
    public function getDatatableOsobyRenderers()
    {
        return [
            0 => [
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            ],
            1 => [
                'view' => 'SsfzBundle:Beneficjent:_osobaZatrudnionaFullName.html.twig',
            ],
            2 => [
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            ],
            3 => [
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            ],
            4 => [
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            ],
            5 => [
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            ],
            6 => [
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            ],
        ];
    }

    /**
     * Zwraca datatable z osobami zatrudnionymi beneficjenta
     *
     * @param Controller $parentObj
     * @param int $beneficjentId
     *
     * @return object
     */
    public function datatableOsoby($parentObj, $beneficjentId)
    {
        return $parentObj
            ->get('datatable')
            ->setDatatableId('dta-osoby')
            ->setEntity('SsfzBundle:OsobaZatrudniona', 'o')
            ->setFields($this->getDatatableOsobyFields())
            ->setSearch(true)
            ->setRenderers($this->getDatatableOsobyRenderers())
            ->setWhere('o.beneficjentId = :beneficjentId', [
                'beneficjentId' => (string) $beneficjentId,
            ]);
    }
}
