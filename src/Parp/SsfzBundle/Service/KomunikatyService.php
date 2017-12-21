<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Parp\SsfzBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Usługa do wyświetlania komunkatów poprzez flashBag
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class KomunikatyService
{

    /**
     *
     * @var Session
     */
    protected $session;

    /**
     * Konstruktor
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Dodaje do sesji (FlashBag) komunikat o operacji zakończonej sukcesem
     * 
     * @param string $komunikat komunikat do wyświetlenia
     */
    public function sukcesKomunikat($komunikat)
    {
        $this->wyswietlKomunikat($komunikat, 'sukces');
    }

    /**
     * Dodaje do sesji (FlashBag) komunikat o operacji zakończonej błędem
     * 
     * @param string $komunikat komunikat do wyświetlenia
     */
    public function bladKomunikat($komunikat)
    {
        $this->wyswietlKomunikat($komunikat, 'blad');
    }

    /**
     * Dodaje do sesji komunikat podanego typu
     * 
     * Umozliwia dodanie komunikatu o błędzie i sukcesie
     * 
     * @param string $komunikat treść komunikatu
     * @param string $typ       typ komunikatu. Możliwe wartosci to: blad, sukces
     */
    public function wyswietlKomunikat($komunikat, $typ)
    {
        $komInfo = array(
            'message' => $komunikat
        );
        switch ($typ) {
            case 'blad':
                $komInfo['alert'] = 'danger';
                $komInfo['title'] = 'Błąd';
                break;
            case 'sukces':
                $komInfo['alert'] = 'success';
                $komInfo['title'] = 'Sukces';
        }
        $this->session->getFlashBag()->add(
            'notice', $komInfo
        );
    }
}
