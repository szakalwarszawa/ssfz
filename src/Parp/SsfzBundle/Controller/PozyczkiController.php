<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\DanePozyczki;
use Parp\SsfzBundle\Form\Type\DanePozyczkiType;

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
     * @Route("formularz/dane_pozyczki/{id}", name="formularz_danych_pozyczki")
     *
     * @param Request $request
     * @param int $id Identyfikator danych pożyczki
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function wyswietlFormularzDanychPozyczkiAction(Request $request, int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $danePozyczki = $entityManager->getRepository(DanePozyczki::class)->find($id);
        if (!$danePozyczki) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczki o ID: '.(string) $id);
        }

        $actionUrl = $this->generateUrl('formularz_danych_pozyczki', [
            'id' => $id,
        ]);
        $formularz = $this->createForm(DanePozyczkiType::class, $danePozyczki, [
            'action_url' => $actionUrl,
        ]);

        return $this->render('SsfzBundle:Report:dane_pozyczki.html.twig', [
            'form'            => $formularz->createView(),
            'dane_pozyczki'   => $danePozyczki,
            'fluid_container' => true,
        ]);
    }
}
