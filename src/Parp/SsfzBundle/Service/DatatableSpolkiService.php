<?php
/**
 * Serwis obsługujący grid spółek
 *
 * @category Service
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
namespace Parp\SsfzBundle\Service;

/**
 * Serwis obsługujący grid spółek
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class DatatableSpolkiService
{

    /**
     * Zwraca pola tabeli spółek
     * 
     * @return array
     */
    public function getDatatableSpolkiFields()
    {
        return array(
            'Lp.' => 's.liczbaPorzadkowa',
            'Nazwa spółki' => 's.nazwa',
            'Forma prawna' => 's.forma',
            'Siedziba (Miasto)' => 's.siedzibaMiasto',
            'Siedziba (Województwo)' => 's.siedzibaWojewodztwo',
            'Branża' => 's.branza',
            'Krótki opis przedmiotu działalności' => 's.opis',
            'Data powołanis spółki' => 's.dataPowolania',
            'Nr KRS' => 's.krs',
            'NIP' => 's.nip',
            'Kwota inwestycji beneficjenta' => 's.kwInwestycji',
            'W tym ze środków wsparcia' => 's.kwWsparcia',
            'W tym ze środków prywatnych' => 's.kwPryw',
            'Czy inwestycja zakończona' => 's.zakonczona',
            'Data wyjścia z inwestycji' => 's.dataWyjscia',
            'Kwota uzyskana z dezinwestycji' => 's.kwDezinwestycji',
            'Zwrot inwestycji' => 's.zwrotInwestycji',
            'NPV' => 's.npv',
            'Udziałowcy' => 's.udzialowcy',
            'Prezes Zarządu' => 's.prezes',
            'Pozostali Członkowie Zarządu' => 's.zarzadPozostali',
            'ZakonczonaRaw' => 's.zakonczona',
            ' ' => 's.id',
            '  ' => 's.id',
            '_identifier_' => 's.id');
    }

    /**
     * Zwraca tablicę rendererów tabeli spółek
     * 
     * @return array
     */
    public function getDatatableSpolkiRenderers()
    {
        $renderers[14]['view'] = 'SsfzBundle:Beneficjent:_date.html.twig';
        $renderers[7]['view'] = 'SsfzBundle:Beneficjent:_date.html.twig';
        $renderers[13]['view'] = 'SsfzBundle:Portfel:_zakonczona.html.twig';
        $renderers[22]['view'] = 'SsfzBundle:Portfel:_spolkaActions.html.twig';
        $renderers[23]['view'] = 'SsfzBundle:Parp:_portfelActions.html.twig';

        return $renderers;
    }

    /**
     * Zwraca datatable spółek
     * 
     * @param Controller $parentObj
     * @param int        $umowaId
     * 
     * @return datatable
     */
    public function datatableSpolki($parentObj, $umowaId)
    {
        return $parentObj->get('datatable')
                ->setDatatableId('dta-spolki')
                ->setEntity('SsfzBundle:Spolka', 's')
                ->setFields($this->getDatatableSpolkiFields())
                ->setSearch(true)
                ->setRenderers($this->getDatatableSpolkiRenderers())
                ->setWhere(
                    's.umowaId = :umowaId', array('umowaId' => (string) $umowaId)
                );
    }
}
