<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Parp\SsfzBundle\Entity\DanePozyczki;

/**
 * Punkt wejściowy do obsługi danych o pożyczkach dla SPO WKP 1.2.1.
 *
 * @Route("/pozyczki")
 */
class PozyczkiController extends Controller
{
    /**
     * Wyświetla formularz danych pożyczki.
     *
     * Uwaga! Akcja do użytku deweloperskiego, w celu rozwijania formularza w oderwaniu
     * od reszty aplikacji. Docelowo prawdopodobnie zostanie bardziej zintegrowane z resztą
     * funkcjonalności.
     *
     * @Route("/formularz", name="pozyczki/formularz/dane_pozyczki/{id}")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function wyswietlFormularzDanychPozyczkiAction(Request $request, int $id)
    {
        //$entityManager = $this->getDoctrine()->getManager();

        $danePozyczki = new DanePozyczki(1);
        $formularz = $this->createForm(DanePozyczkiType::class, $danePozyczki, []);

        return $this->render('SsfzBundle:Report:rejestruj.html.twig', [
            'form'      => $form->createView(),
            'form_mode' => $mode,
            'umowaId'   => $umowaId,
        ]);
    }
}
