<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Form\Type\SpolkaType;
use Parp\SsfzBundle\Form\Type\SprawozdanieOcenType;
use Carbon\Carbon;

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
        $this->getNarzedziaService()->datatableParp($this);
        
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
        $em = $this->getDoctrine()->getManager();
        $sprawozdanie = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($idSprawozdania);
        if ($sprawozdanie == null) {
            $this->getNarzedziaService()->dodajFlash($this, 'Błąd.', 'Nie znaleziono sprawozdania o podanym identyfikatorze.', 'danger');
            
            return $this->redirectToRoute('parp');
        }
        if ($sprawozdanie->getStatus() != 2) {
            $this->getNarzedziaService()->dodajFlash($this, '', 'Sprawozdanie nie ma statusu "przesłane". Ocena sprawozdania z innym statusem jest niemożliwa.', 'warning');
            
            return $this->redirectToRoute('parp_sprawozdanie', array('idSprawozdania' => $idSprawozdania));
        }
        if ($sprawozdanie->getStatus() == 2 && $sprawozdanie->getOceniajacyId() != null && $uzytkownik->getId() != $sprawozdanie->getOceniajacyId()) {
            $this->getNarzedziaService()->dodajFlash($this, '', 'Sprawozdanie jest zajęte do oceny przez innego użytkownika.', 'warning');
            
            return $this->redirectToRoute('parp_sprawozdanie', array('idSprawozdania' => $idSprawozdania));
        }
        $formS = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $sprawozdanie, array('disabled' => true));
        $przeplyw = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanie->getId()));
        $formP = null;
        if ($przeplyw != null) {
            $formP = $this->createForm(\Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType::class, $przeplyw[0], array('disabled' => true))->createView();             
        }
        
        $sprawozdanie->setOceniajacyId($uzytkownik->getId());
        $form = $this->createForm(SprawozdanieOcenType::class, $sprawozdanie);
        $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->persist($sprawozdanie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($sprawozdanie->getStatus() == 2) {
                $sprawozdanie->setOceniajacyId(null);
            }            
            if ($sprawozdanie->getStatus() != 2) {
                $sprawozdanie->setDataZatwierdzenia(new Carbon('Europe/Warsaw'));
            }                         
            $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->persist($sprawozdanie);
            
            return $this->redirectToRoute('parp');
        }        
        
        return $this->render(
            'SsfzBundle:Parp:ocen.html.twig',
            array(
                'form' => $form->createView(),
                'sprawozdanie' => $sprawozdanie,
                'formS' => $formS->createView(),
                'formP' => $formP                
            )
        );          
    }    

    /**
     * Akcja podglądu sprawozdania
     * 
     * @param Request $request        request
     * @param int     $idSprawozdania identyfikator sprawozdania
     * 
     * @Route("/sprawozdanie/{idSprawozdania}", name="parp_sprawozdanie")
     * 
     * @return Response
     */
    public function sprawozdanieAction(Request $request, $idSprawozdania)
    {
        $em = $this->getDoctrine()->getManager();
        $sprawozdanie = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($idSprawozdania);
        if ($sprawozdanie == null) {
            $this->getNarzedziaService()->dodajFlash($this, 'Błąd.', 'Nie znaleziono sprawozdania o podanym identyfikatorze.', 'danger');
            
            return $this->redirectToRoute('parp');
        }           
        $formS = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $sprawozdanie, array('disabled' => true));
        $przeplyw = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanie->getId()));
        $formP = null;
        if ($przeplyw != null) {
            $formP = $this->createForm(\Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType::class, $przeplyw[0], array('disabled' => true))->createView();             
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
     * @param Request $request        request
     * @param int     $idBeneficjenta identyfikator profilu beneficjenta
     * 
     * @Route("/beneficjent/{idBeneficjenta}", name="parp_beneficjent")
     * 
     * @return Response
     */
    public function beneficjentAction(Request $request, $idBeneficjenta)
    {
        $em = $this->getDoctrine()->getManager();
        $beneficjent = $em->getRepository(\Parp\SsfzBundle\Entity\Beneficjent::class)->find($idBeneficjenta);
        if ($beneficjent == null) {
            $this->getNarzedziaService()->dodajFlash($this, 'Błąd.', 'Nie znaleziono beneficjenta o podanym identyfikatorze.', 'danger');
            
            return $this->redirectToRoute('parp');
        }        
        $this->get('ssfz.service.narzedzia_service')->datatableOsoby($this, $beneficjent->getId())->execute();        
        
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
     * @return Response
     */
    public function spolkiGridAction($idUmowy)
    {
        $umowa= $this->getDoctrine()->getRepository(Umowa::class)->find($idUmowy);
        if (!$umowa) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Nie znaleziono umowy o przekazanym identyfikatorze.');
        }             
        $umowaId = $umowa->getId();
        
        return $this->get('ssfz.service.narzedzia_service')->datatableSpolki($this, $umowaId)->execute();
    }     
             
    /**
     * Akcja wyświetlenia portfela spółek
     * 
     * @param Request $request request
     * @param int     $idUmowy identyfikator umowy
     * 
     * @Route("/portfel/{idUmowy}", name="parp_portfel")
     * 
     * @return Response
     */
    public function portfelAction(Request $request, $idUmowy)
    {
        $em = $this->getDoctrine()->getManager();
        $umowa = $em->getRepository(\Parp\SsfzBundle\Entity\Umowa::class)->find($idUmowy);
        if ($umowa == null) {
            $this->getNarzedziaService()->dodajFlash($this, 'Błąd.', 'Nie znaleziono umowy o podanym identyfikatorze.', 'danger');
            
            return $this->redirectToRoute('parp');
        }        
        $this->get('ssfz.service.narzedzia_service')->datatableSpolki($this, $umowa->getId())->execute();
        $spolka = new \Parp\SsfzBundle\Entity\Spolka();
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
        return $this->get('ssfz.service.narzedzia_service')->datatableOsoby($this, $idBeneficjenta)->execute();
    }    
    
    /**
     * Pobiera serwis NarzedziaService
     * 
     * @return NarzedziaService
     */
    private function getNarzedziaService()
    {
        return $this->get('ssfz.service.narzedzia_service');
    }
    
    /**
     * Akcja pobrania danych do tabeli kontroli sprawozdawczości
     *
     * @Route("/gridParp", name="datatableParp")
     * @return             Response
     */
    public function parpGridAction()
    {
        return $this->getNarzedziaService()->datatableParp($this)->execute();
    }
    
    /**
     * Pobiera zalogowanego użytkownika
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
}
