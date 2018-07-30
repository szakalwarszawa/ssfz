<?php
/**
 * Serwis obsługujący grid umów
 *
 * @category Service
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
namespace Parp\SsfzBundle\Service;

/**
 * Serwis obsługujący grid umów
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class DatatableUmowyService
{

    /**
     * Zwraca pola tabeli umów beneficjenta
     * 
     * @return array
     */
    public function getDatatableUmowyFields()
    {
        return array(
            'Numer umowy' => 'u.numer',
            '' => 'u.id',
            '_identifier_' => 'u.id');
    }

    /**
     * Zwraca tablicę rendererów tabeli umów beneficjenta
     * 
     * @return array
     */
    public function getDatatableUmowyRenderers()
    {
        return array(
            1 => array(
                'view' => 'SsfzBundle:Beneficjent:_umowaActions.html.twig',
            )
        );
    }

    /**
     * Zwraca datatable z umowami beneficjenta
     * 
     * @param Controller $parentObj
     * @param int        $beneficjentId
     * 
     * @return datatable
     */
    public function datatableUmowy($parentObj, $beneficjentId)
    {
        return $parentObj->get('datatable')
                ->setDatatableId('dta-umowy')
                ->setEntity('SsfzBundle:Umowa', 'u')
                ->setFields($this->getDatatableUmowyFields())
                ->setSearch(true)
                ->setRenderers($this->getDatatableUmowyRenderers())
                ->setWhere(
                    'u.beneficjentId = :beneficjentId', array('beneficjentId' => (string) $beneficjentId)
                );
    }
}