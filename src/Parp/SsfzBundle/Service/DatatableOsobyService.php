<?php
/**
 * Serwis obsługujący grid osób zatrudnionych
 *
 * @category Service
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
namespace Parp\SsfzBundle\Service;

/**
 * Serwis obsługujący grid osób zatrudnionych
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
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
        return array(
            'Imię' => 'o.imie',
            'Imię i nazwisko' => 'o.nazwisko',
            'Rodzaj umowy' => 'o.umowaRodzaj',
            'Data zawarcia umowy' => 'o.umowaData',
            'Data rozpoczęcia pracy' => 'o.rozpoczecieData',
            'Stanowisko' => 'o.stanowisko',
            'Wymiar etatu' => 'o.wymiar',
            '_identifier_' => 'o.id'
        );
    }

    /**
     * Zwraca tablicę rendererów tabeli osób zatrudnionych
     * 
     * @return array
     */
    public function getDatatableOsobyRenderers()
    {
        return array(
            1 => array(
                'view' => 'SsfzBundle:Beneficjent:_osobaZatrudnionaFullName.html.twig',
            ),
            3 => array(
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            ),
            4 => array(
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            ),
            5 => array(
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            ),
            6 => array(
                'view' => 'SsfzBundle:Datatable:_escapeJs.html.twig',
            )


        );
    }

    /**
     * Zwraca datatable z osobami zatrudnionymi beneficjenta
     * 
     * @param Controller $parentObj
     * @param int        $beneficjentId
     * 
     * @return datatable
     */
    public function datatableOsoby($parentObj, $beneficjentId)
    {
        return $parentObj->get('datatable')
                ->setDatatableId('dta-osoby')
                ->setEntity('SsfzBundle:OsobaZatrudniona', 'o')
                ->setFields($this->getDatatableOsobyFields())
                ->setSearch(true)
                ->setRenderers($this->getDatatableOsobyRenderers())
                ->setWhere(
                    'o.beneficjentId = :beneficjentId', array('beneficjentId' => (string) $beneficjentId)
                );
    }
}
