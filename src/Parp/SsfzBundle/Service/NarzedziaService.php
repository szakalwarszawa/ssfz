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
class NarzedziaService
{
    /**
     * Repozytorium encji BeneficjentFormaPrawna
     * 
     * @var BeneficjentFormaPrawnaRepository
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
     * Repozytorium encji OkresyKonfiguracja
     * 
     * @var OkresyKonfiguracjaRepository
     */
    private $okresyKonfiguracjaRepo;
    /**
     * Konstruktor parametryczny
     * 
     * @param BeneficjentFormaPrawnaRepository $dictFormaRepo          repozytorium BeneficjentFormaPrawnaRepository
     * @param WojewodztwoRepository            $dictWojRepo            repozytorium WojewodztwoRepository
     * @param GospodarkaDzialRepository        $dictDzialRepo          repozytorium GospodarkaDzialRepository
     * @param OkresyKonfiguracjaRepository     $okresyKonfiguracjaRepo repozytorium OkresyKonfiguracjaRepository
     */
    public function __construct($dictFormaRepo, $dictWojRepo, $dictDzialRepo, $okresyKonfiguracjaRepo)
    {
        $this->dictFormaRepo = $dictFormaRepo;
        $this->dictWojRepo = $dictWojRepo;
        $this->dictDzialRepo = $dictDzialRepo;     
        $this->okresyKonfiguracjaRepo = $okresyKonfiguracjaRepo;  
    }
    /**
     * Zwraca słownik form prawnych beneficjenta
     * 
     * @param  string $sort
     * @return array
     */
    public function getSlownikBeneficjentFormaPrawna($sort = null)
    {
        if (!$sort) {
            
            return $this->dictFormaRepo->findBy(array(), array('id'=> 'ASC'));
        }
        
        return $this->dictFormaRepo->findBy(array(), array('nazwa' => $sort));
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
            
            return $this->dictWojRepo->findBy(array(), array('id'=> 'ASC'));
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
            
            return $this->dictDzialRepo->findBy(array(), array('id'=> 'ASC'));
        }        
        
        return $this->dictDzialRepo->findBy(array(), array('nazwa' => $sort));
    }     
    /**
     * Zwraca pola tabeli osób zatrudnionych
     * 
     * @return array
     */ 
    public function getDatatableOsobyFields()
    {
        return  array(                       
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
        return  array(
                    1 => array(
                        'view' => 'SsfzBundle:Beneficjent:_osobaZatrudnionaFullName.html.twig',
                    ),
                    3 => array(
                        'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
                    ),
                    4 => array(
                        'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
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
        return  array(
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
                'u.beneficjentId = :beneficjentId', 
                array('beneficjentId' => (string) $beneficjentId)
            );              
    } 
    /**
     * Zwraca pola tabeli spółek
     * 
     * @return array
     */ 
    public function getDatatableSpolkiFields()
    {
        return array(
                    'Lp.' => 's.lp',
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
                's.umowaId = :umowaId', 
                array('umowaId' => (string) $umowaId)
            );              
    }
    /**
     * Zwraca konfigurację tabeli Parp
     * 
     * @return array
     */
    public function getParpKonfiguracja()
    {
        return $this->okresyKonfiguracjaRepo->findBy(array(), array('rok'=> 'ASC'));
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
            $fields['1 - 6 '.$cfg->getRok()] = 's'.$idx.'.idStatus';
            $idx++;
            $fields['7 - 12 '.$cfg->getRok()] = 's'.$idx.'.idStatus';
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
        $datatable->addJoin('u.beneficjent', 'b', \Doctrine\ORM\Query\Expr\Join::INNER_JOIN);//, \Doctrine\ORM\Query\Expr\Join::WITH, 'b.id = u.beneficjentId');  
        $idx = 1;
        foreach ($config as $cfg) {
            $datatable->addJoin('u.sprawozdania', 's'.$idx, \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = s'.$idx.'.umowaId and s'.$idx.'.rok = '.$cfg->getRok().' and s'.$idx.'.okresId = 0 and s'.$idx.'.czyNajnowsza = 1');                
            $idx++;
            $datatable->addJoin('u.sprawozdania', 's'.$idx, \Doctrine\ORM\Query\Expr\Join::LEFT_JOIN, \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = s'.$idx.'.umowaId and s'.$idx.'.rok = '.$cfg->getRok().' and s'.$idx.'.okresId = 1 and s'.$idx.'.czyNajnowsza = 1');
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
    /**
     * Dodaje komunikat do flashbag
     * 
     * @param Controller $parentObj
     * @param string     $tytul
     * @param string     $tresc
     * @param string     $poziom
     */
    public function dodajFlash($parentObj, $tytul, $tresc, $poziom)
    {
        $parentObj->get('session')->getFlashBag()->add(
            'notice', array(
            'alert' => $poziom,
            'title' => $tytul,
            'message' => $tresc
            )
        );
    }  
    /**
     * Zwraca repozytorium BeneficjentFormaPrawnaRepository
     * 
     * @return BeneficjentFormaPrawnaRepository
     */
    public function getBeneficjentFormaPrawnaRepo()
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
