<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\DanePozyczek;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Form\Type\DanePozyczekType;

/**
 * Punkt wejściowy do obsługi danych o pożyczkach dla SPO WKP 1.2.1.
 *
 * @Route("/dane_pozyczek")
 */
class PozyczkiController extends Controller
{
    /**
     * Wyświetla formularz danych pożyczek na podstawie ID sprawozdania, do którego należy.
     *
     * @Method({"GET"})
     * @Route("/sprawozdanie/edycja/{id}", name="edycja_danych_pozyczek_dla_sprawozdania")
     *
     * @param Request $request
     * @param int $id Identyfikator sprawozdania pożyczkowego
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function edytujDanePozyczekDlaSprawozdaniaAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczek = $entityManager
            ->getRepository(DanePozyczek::class)
            ->findOneByIdSprawozdania($id)
        ;
        if (!$danePozyczek) {
            $sprawozdanie = $entityManager
                ->getRepository(SprawozdaniePozyczkowe::class)
                ->find($id)
            ;
            if (!$sprawozdanie) {
                throw new EntityNotFoundException('Nie znaleziono sprawozdania pożyczkowego o ID: ' . (string) $id);
            }

            $danePozyczek = $entityManager
                ->getRepository(DanePozyczek::class)
                ->create($sprawozdanie, true)
            ;

            return $this->edytujDanePozyczekAction($request, $danePozyczek->getId());
        }

        return $this->edytujDanePozyczekAction($request, $danePozyczek->getId());
    }

    /**
     * Wyświetla formularz danych pożyczek na podstawie jego ID.
     *
     * @Method({"GET", "POST"})
     * @Route("/{id}", name="edycja_danych_pozyczek")
     *
     * @param Request $request
     * @param int $id Identyfikator danych pożyczki
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function edytujDanePozyczekAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczek = $entityManager
            ->getRepository(DanePozyczek::class)
            ->find($id)
        ;

        if (!$danePozyczek) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczek o ID: ' . (string) $id);
        }

        $actionUrl = $this->generateUrl('edycja_danych_pozyczek', [
            'id' => $id,
        ]);

        $formularz = $this->createForm(DanePozyczekType::class, $danePozyczek, [
            'action_url' => $actionUrl,
        ]);

        $isPost = ($request->getMethod() === 'POST');
        if ($isPost) {
            $formularz->handleRequest($request);
            if ($formularz->isSubmitted() && $formularz->isValid()) {
                $entityManager->flush();
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Dane pożyczek zostały zapisane.')
                ;
            } else {
                $errors = (string) $formularz->getErrors(true, false);
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat('Formularz zawiera nieprawidłowe dane pożyczek . ' . "<br />" . $errors)
                ;
            }
        }

        return $this->render('SsfzBundle:Sprawozdanie:dane_pozyczek.html.twig', [
            'form'            => $formularz->createView(),
            'dane_pozyczek'   => $danePozyczek,
            'fluid_container' => true,
        ]);
    }

    /**
     * Wyświetla raport z podsumowaniem danych pożyczek dla sprawozdania o zadanym ID.
     *
     * @Method({"GET"})
     * @Route("/sprawozdanie/podglad/{id}", name="podglad_danych_pozyczek_dla_sprawozdania")
     *
     * @param Request $request
     * @param int $id Identyfikator sprawozdania pożyczkowego
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function pokazDanePozyczekDlaSprawozdaniaAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $daneZagregowane = $entityManager
            ->getRepository(DanePozyczek::class)
            ->findDaneZagregowaneByIdSprawozdania($id)
        ;

        if (!$daneZagregowane) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczek dla sprawozdania o ID: ' . (string) $id);
        }

        return $this->render('SsfzBundle:Report:dane_pozyczek.html.twig', [
            'dane_zagregowane' => $daneZagregowane,
            'fluid_container'  => false,
        ]);
    }

    /**
     * Usuwa dane pożyczek o zadanym ID.
     *
     * @todo Dodać sprawdzanie uprawnień do usuwanych danych.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function usunDanePozyczekAction(Request $request, int $id)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePozyczek = $entityManager
            ->getRepository(DanePozyczek::class)
            ->find($id)
        ;

        if (!$danePozyczek) {
            throw new EntityNotFoundException('Nie znaleziono danych pożyczek o ID: ' . (string) $id);
        }

        $sprawozdanie = $danePozyczek->getSprawozdanie();

        $danePozyczek = $entityManager
            ->getRepository(DanePozyczek::class)
            ->remove($danePozyczek, true)
        ;

        return $this->forward('AppBundle:Something:fancy', [
            'id'      => $sprawozdanie->getId(),
            'request' => $request,
        ]);
    }
}
