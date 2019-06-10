<?php

namespace Parp\SsfzBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Usługa do wyświetlania komunkatów poprzez flashBag
 */
class KomunikatyService
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * Konstruktor.
     *
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
     * @param string $tytul tytuł komunikatu
     */
    public function sukcesKomunikat($komunikat, $tytul = 'Sukces')
    {
        $this->wyswietlKomunikat($komunikat, 'sukces', $tytul);
    }

    /**
     * Dodaje do sesji (FlashBag) komunikat o operacji zakończonej błędem
     *
     * @param string $komunikat komunikat do wyświetlenia
     * @param string $tytul tytuł komunikatu
     */
    public function bladKomunikat($komunikat, $tytul = 'Błąd')
    {
        $this->wyswietlKomunikat($komunikat, 'blad', $tytul);
    }
    /**
     * Dodaje do sesji (FlashBag) komunkat o operacji zakończonej ostrzeżeniem
     *
     * @param string $komunikat komunikat do wyświetlenia
     * @param string $tytul tytuł komunikatu
     */
    public function ostrzezenieKomunikat($komunikat, $tytul = 'Uwaga')
    {
        $this->wyswietlKomunikat($komunikat, 'Ostrzezenie', $tytul);
    }

    /**
     * Dodaje do sesji komunikat podanego typu
     *
     * Umozliwia dodanie komunikatu o błędzie i sukcesie
     *
     * @param string $komunikat treść komunikatu
     * @param string $typ       typ komunikatu. Możliwe wartosci to: blad, sukces
     * @param string $tytul     tytuł komunikatu
     */
    public function wyswietlKomunikat($komunikat, $typ, $tytul)
    {
        $komInfo = [
            'message' => $komunikat,
            'title'   => $tytul
        ];

        switch ($typ) {
            case 'blad':
                $komInfo['alert'] = 'danger';
                break;
            case 'sukces':
                $komInfo['alert'] = 'success';
                break;
            case 'ostrzezenie':
                $komInfo['alert'] = 'warning';
                break;
        }

        $this
            ->session
            ->getFlashBag()
            ->add('notice', $komInfo)
        ;
    }
}
