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

        return $this->edytujDanePoreczenkAction($request, $danePoreczen->getId());
    }
}
