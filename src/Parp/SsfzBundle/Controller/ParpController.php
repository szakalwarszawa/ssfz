<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Form\Type\SpolkaType;
use Parp\SsfzBundle\Form\Type\SprawozdanieOcenType;
use Carbon\Carbon;
use Parp\SsfzBundle\Form\Type\SprawozdanieType;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;
use Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType;
use Parp\SsfzBundle\Entity\Beneficjent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Parp\SsfzBundle\Entity\Spolka;

/**
 * @Route("/parp", name="parp")
 */
class ParpController extends Controller
{
    /**
     * Akcja domyślana - wyświetla panel kontroli sprawozdawczości
     *
     * @Route("", name="parp")
     *
     * @return Response
     */
    public function indexAction()
    {
        $this->get('ssfz.service.datatable_parp_service')->datatableParp($this);

        return $this->render('SsfzBundle:Parp:index.html.twig');
    }

    /**
     * Akcja oceń sprawozdanie
     *
     * @param Request $request        request
     * @param int     $idSprawozdania identyfikator sprawozdania
     *
     * @Route("/ocen/{idSprawozdania}", name="ocen")
     *
     * @return Response
     */
    public function ocenAction(Request $request, $idSprawozdania)
    {
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $sprawozdanie = $entityManager->getRepository(Sprawozdanie::class)->find($idSprawozdania);
        if (null == $sprawozdanie) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono sprawozdania o podanym identyfikatorze.');
            return $this->redirectToRoute('parp');
        }
        if (2 !== $sprawozdanie->getStatus()) {
            $this->addFlash(
                'notice', array(
                'alert' => 'warning',
                'title' => '',
                'message' => 'Sprawozdanie nie ma statusu "przesłane". Ocena sprawozdania z innym statusem jest niemożliwa.'
                )
            );
            return $this->redirectToRoute('parp_sprawozdanie', array('idSprawozdania' => $idSprawozdania));
        }
        if (2 === $sprawozdanie->getStatus() && null !== $sprawozdanie->getOceniajacyId() && $uzytkownik->getId() !== $sprawozdanie->getOceniajacyId()) {
            $this->addFlash(
                'notice', array(
                'alert' => 'warning',
                'title' => '',
                'message' => 'Sprawozdanie jest zajęte do oceny przez innego użytkownika.'
                )
            );
            return $this->redirectToRoute('parp_sprawozdanie', array('idSprawozdania' => $idSprawozdania));
        }
        $okresy = $this->getOkresySprawozdawcze();
        $formS = $this->createForm(SprawozdanieType::class, $sprawozdanie, array('disabled' => true, 'okresy' => $okresy));
        $przeplyw = $entityManager->getRepository(PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanie->getId()));
        $formP = null;
        if ($przeplyw != null) {
            $formP = $this->createForm(PrzeplywFinansowyType::class, $przeplyw[0], array('disabled' => true))->createView();
        }

        $sprawozdanie->setOceniajacyId($uzytkownik->getId());
        $form = $this->createForm(SprawozdanieOcenType::class, $sprawozdanie);
        $entityManager->getRepository(Sprawozdanie::class)->persist($sprawozdanie);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if (2 === $sprawozdanie->getStatus()) {
                    $sprawozdanie->setOceniajacyId(null);
                }
                if (2 !== $sprawozdanie->getStatus()) {
                    $sprawozdanie->setDataZatwierdzenia(new Carbon('Europe/Warsaw'));
                }
                $entityManager->getRepository(Sprawozdanie::class)->persist($sprawozdanie);

                return $this->redirectToRoute('parp');
            }
        }

        return $this->render(
            'SsfzBundle:Parp:ocen.html.twig',
            array(
                'form' => $form->createView(),
                'sprawozdanie' => $sprawozdanie,
                'formS' => $formS->createView(),
                'formP' => $formP,
            )
        );
    }

    /**
     * Akcja podglądu sprawozdania
     *
     * @param int $idSprawozdania identyfikator sprawozdania
     *
     * @Route("/sprawozdanie/{idSprawozdania}", name="parp_sprawozdanie")
     *
     * @return Response
     */
    public function sprawozdanieAction($idSprawozdania)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $sprawozdanie = $entityManager->getRepository(Sprawozdanie::class)->find($idSprawozdania);
        if (null == $sprawozdanie) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono sprawozdania o podanym identyfikatorze.');

            return $this->redirectToRoute('parp');
        }
        $okresy = $this->getOkresySprawozdawcze();
        $formS = $this->createForm(SprawozdanieType::class, $sprawozdanie, array('disabled' => true, 'okresy' => $okresy));
        $przeplyw = null;
        $przeplyw = $entityManager->getRepository(PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanie->getId()));
        $formP = null;
        if (null != $przeplyw) {
            $formP = $this->createForm(PrzeplywFinansowyType::class, $przeplyw[0], array('disabled' => true))->createView();
        }

        return $this->render(
            'SsfzBundle:Parp:sprawozdanie.html.twig',
            array(
                'sprawozdanie' => $sprawozdanie,
                'formS' => $formS->createView(),
                'formP' => $formP
            )
        );
    }

    /**
     * Akcja podglądu profilu beneficjenta
     *
     * @param int $idBeneficjenta identyfikator profilu beneficjenta
     *
     * @Route("/beneficjent/{idBeneficjenta}", name="parp_beneficjent")
     *
     * @return Response
     */
    public function beneficjentAction($idBeneficjenta)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $beneficjent = $entityManager->getRepository(Beneficjent::class)->find($idBeneficjenta);
        if (null == $beneficjent) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono beneficjenta o podanym identyfikatorze.');
            return $this->redirectToRoute('parp');
        }
        $this->get('ssfz.service.datatable_osoby_service')->datatableOsoby($this, $beneficjent->getId())->execute();

        return $this->render(
            'SsfzBundle:Parp:beneficjent.html.twig',
            array(
                'beneficjent' => $beneficjent,
            )
        );
    }

    /**
     * Akcja pobrania danych do tabeli spółek
     *
     * @param int $idUmowy identyfikator umowy
     *
     * @Route("/gridSpolki/{idUmowy}", name="parp_datatableSpolki")
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function spolkiGridAction($idUmowy)
    {
        $umowa = $this->getDoctrine()->getRepository(Umowa::class)->find($idUmowy);
        if (!$umowa) {
            throw new NotFoundHttpException('Nie znaleziono umowy o przekazanym identyfikatorze.');
        }
        $umowaId = $umowa->getId();

        return $this->get('ssfz.service.datatable_spolki_service')->datatableSpolki($this, $umowaId)->execute();
    }

    /**
     * Akcja wyświetlenia portfela spółek
     *
     * @param int $idUmowy identyfikator umowy
     *
     * @Route("/portfel/{idUmowy}", name="parp_portfel")
     *
     * @return Response
     */
    public function portfelAction($idUmowy)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $umowa = $entityManager->getRepository(Umowa::class)->find($idUmowy);
        if (null == $umowa) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono umowy o podanym identyfikatorze.');
            return $this->redirectToRoute('parp');
        }
        $this->get('ssfz.service.datatable_spolki_service')->datatableSpolki($this, $umowa->getId())->execute();
        $spolka = new Spolka();
        $form = $this->createForm(SpolkaType::class, $spolka, array('disabled' => true, 'narzedzia_svc' => $this->get('ssfz.service.narzedzia_service')));

        return $this->render(
            'SsfzBundle:Parp:portfel.html.twig',
            array(
                'umowa' => $umowa,
                'beneficjent_nazwa' => $umowa->getBeneficjent()->getNazwa(),
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Akcja pobierająca dane do tabeli Osoby zatrudnione
     *
     * @param int $idBeneficjenta identyfikator profilu beneficjenta
     *
     * @Route("/gridOsoby/{idBeneficjenta}", name="parp_datatableOsoby")
     *
     * @return Response
     */
    public function osobyGridAction($idBeneficjenta)
    {
        return $this->get('ssfz.service.datatable_osoby_service')->datatableOsoby($this, $idBeneficjenta)->execute();
    }

    /**
     * Akcja pobrania danych do tabeli kontroli sprawozdawczości
     *
     * @Route("/gridParp", name="datatableParp")
     * @return             Response
     */
    public function parpGridAction()
    {
        return $this->get('ssfz.service.datatable_parp_service')->datatableParp($this)->execute();
    }

    /**
     * Pobiera zalogowanego użytkownika
     *
     * @throws AccessDeniedException
     *
     * @return Uzytkownik
     */
    protected function getZalogowanyUzytkownik()
    {
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        if (!$uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }

     /**
     * Metoda umożliwia pobranie okresów sprawozdawczych z bazy danych
     *
     * @return array
     */
    private function getOkresySprawozdawcze()
    {
        $array = array();
        $entityManager = $this->getDoctrine()->getManager();
        $okresySprawozdawcze = $entityManager
            ->getRepository(\Parp\SsfzBundle\Entity\OkresyKonfiguracja::class)
            ->findBy(array(), array('rok' => 'ASC'))
        ;
        foreach ($okresySprawozdawcze as $okres) {
            $array[$okres->getRok()]  = $okres->getRok();
        }

        return $array;
    }
}
