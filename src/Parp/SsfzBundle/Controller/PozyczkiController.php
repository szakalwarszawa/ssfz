<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\DanePozyczki;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Form\Type\DanePozyczkiType;

/**
 * Punkt wejściowy do obsługi danych o pożyczkach dla SPO WKP 1.2.1.
 *
 * @Route("/dane_pozyczki")
 */
class PozyczkiController extends Controller
{
    /**
     * Wyświetla formularz danych pożyczki na podstawie ID sprawozdania, do którego należy.
     *
     * @Method({"GET"})
     * @Route("/sprawozdanie/edycja/dane_pozyczki/{id}", name="edycja_danych_pozyczki_dla_sprawozdania")
     *
     * @param Request $request
     * @param int $id Identyfikator sprawozdania pożyczkowego
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function edytujDanePozyczkiDlaSprawozdaniaAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczki = $entityManager
            ->getRepository(DanePozyczki::class)
            ->findOneByIdSprawozdania($id)
        ;
        if (!$danePozyczki) {
            $sprawozdanie = $entityManager
                ->getRepository(SprawozdaniePozyczkowe::class)
                ->find($id)
            ;
            if (!$sprawozdanie) {
                throw new EntityNotFoundException('Nie znaleziono sprawozdania pożyczkowego o ID: '.(string) $id);
            }

            $danePozyczki = $entityManager
                ->getRepository(DanePozyczki::class)
                ->create($sprawozdanie, true)
            ;
            return $this->edytujDanePozyczkiAction($request, $danePozyczki->getId());
        }

        return $this->edytujDanePozyczkiAction($request, $danePozyczki->getId());
    }


    /**
     * Wyświetla formularz danych pożyczki na podstawie jej ID.
     *
     * @Method({"GET", "POST"})
     * @Route("/dane_pozyczki/{id}", name="edycja_danych_pozyczki")
     *
     * @param Request $request
     * @param int $id Identyfikator danych pożyczki
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function edytujDanePozyczkiAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczki = $entityManager
            ->getRepository(DanePozyczki::class)
            ->find($id)
        ;
        if (!$danePozyczki) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczki o ID: '.(string) $id);
        }

        $actionUrl = $this->generateUrl('edycja_danych_pozyczki', [
            'id' => $id,
        ]);
        $formularz = $this->createForm(DanePozyczkiType::class, $danePozyczki, [
            'action_url' => $actionUrl,
        ]);

        $isPost = ($request->getMethod() === 'POST');
        if ($isPost) {
            $formularz->handleRequest($request);
            if ($formularz->isSubmitted() && $formularz->isValid()) {
                $entityManager->flush();
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Dane pożyczki zostały zapisane.')
                ;
            } else {
                $errors = (string) $formularz->getErrors(true, false);
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat('Formularz zawiera nieprawidłowe dane pożyczki.'."<br />".$errors)
                ;
            }
        }

        return $this->render('SsfzBundle:Sprawozdanie:dane_pozyczki.html.twig', [
            'form'            => $formularz->createView(),
            'dane_pozyczki'   => $danePozyczki,
            'fluid_container' => true,
        ]);
    }



    /**
     * Wyświetla raport z podsumowaniem danych pożyczki dla sprawozdania o zadanym ID.
     *
     * @Method({"GET"})
     * @Route("/sprawozdanie/podglad/dane_pozyczki/{id}", name="podglad_danych_pozyczki_dla_sprawozdania")
     *
     * @param Request $request
     * @param int $id Identyfikator sprawozdania pożyczkowego
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function pokazDanePozyczkiDlaSprawozdaniaAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $daneZagregowane = $entityManager
            ->getRepository(DanePozyczki::class)
            ->findDaneZagregowaneByIdSprawozdania($id)
        ;
        if (!$daneZagregowane) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczek dla sprawozdania o ID: '.(string) $id);
        }

        return $this->render('SsfzBundle:Report:dane_pozyczki.html.twig', [
            'dane_zagregowane' => $daneZagregowane,
            'fluid_container' => false,
        ]);
    }


    /**
     * Usuwa dane pożyczki o zadanym ID.
     *
     * @todo Dodać sprawdzanie uprawnień do usuwanych danych.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function usunDanePozyczkiAction(Request $request, int $id)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczki = $entityManager
            ->getRepository(DanePozyczki::class)
            ->find($id)
        ;
        if (!$danePozyczki) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczki o ID: '.(string) $id);
        }

        $sprawozdanie = $danePozyczki->getSprawozdanie();

        $danePozyczki = $entityManager
            ->getRepository(DanePozyczki::class)
            ->remove($danePozyczki, true)
        ;

        return $this->forward('AppBundle:Something:fancy', [
            'id'      => $sprawozdanie->getId(),
            'request' => $request,
        ]);
    }
}
