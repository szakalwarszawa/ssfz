<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityNotFoundException;
use Parp\SsfzBundle\Entity\DanePoreczen;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Form\Type\DanePoreczenType;

/**
 * Punkt wejściowy do obsługi danych o poręczeniach dla SPO WKP 1.2.2.
 *
 * @Route("/dane_poreczen")
 */
class PoreczeniaController extends Controller
{
    /**
     * Wyświetla formularz danych poręczeń na podstawie ID sprawozdania, do którego należy.
     *
     * @Method({"GET"})
     * @Route("/sprawozdanie/edycja/{id}", name="edycja_danych_poreczen_dla_sprawozdania")
     *
     * @param Request $request
     * @param int $id Identyfikator sprawozdania poręczeniowego
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function edytujDanePoreczenDlaSprawozdaniaAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePoreczen = $entityManager
            ->getRepository(DanePoreczen::class)
            ->findOneByIdSprawozdania($id)
        ;
        if (!$danePoreczen) {
            $sprawozdanie = $entityManager
                ->getRepository(SprawozdaniePoreczeniowe::class)
                ->find($id)
            ;
            if (!$sprawozdanie) {
                throw new EntityNotFoundException('Nie znaleziono sprawozdania poręczeniowego o ID: '.(string) $id);
            }

            $danePoreczen = $entityManager
                ->getRepository(DanePoreczen::class)
                ->create($sprawozdanie, true)
            ;
            return $this->edytujDanePoreczenAction($request, $danePoreczen->getId());
        }

        return $this->edytujDanePoreczenAction($request, $danePoreczen->getId());
    }















    /**
     * Wyświetla formularz danych poręczeń na podstawie jego ID.
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
    public function edytujDanePoreczenAction(Request $request, int $id): Response
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $danePoreczen = $entityManager
            ->getRepository(DanePoreczen::class)
            ->find($id)
        ;
        if (!$danePoreczen) {
            throw new EntityNotFoundException('Nie znaleziono danych poręczeń o ID: '.(string) $id);
        }

        $actionUrl = $this->generateUrl('edycja_danych_pozyczek', [
            'id' => $id,
        ]);
        $formularz = $this->createForm(DanePoreczenType::class, $danePoreczen, [
            'action_url' => $actionUrl,
        ]);

        $isPost = ($request->getMethod() === 'POST');
        if ($isPost) {
            $formularz->handleRequest($request);
            if ($formularz->isSubmitted() && $formularz->isValid()) {
                $entityManager->flush();
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Dane poręczeń zostały zapisane.')
                ;
            } else {
                $errors = (string) $formularz->getErrors(true, false);
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat('Formularz zawiera nieprawidłowe dane poręczeń.'."<br />".$errors)
                ;
            }
        }

        return $this->render('SsfzBundle:Sprawozdanie:dane_poreczen.html.twig', [
            'form'            => $formularz->createView(),
            'dane_poreczen'   => $danePoreczen,
            'fluid_container' => true,
        ]);
    }
}
