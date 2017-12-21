<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Form\Type\BeneficjentType;

/**
 * Kontroler obsługujący funkcjonalności po stronie Beneficjenta
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 * 
 * @Route("/beneficjent", name="beneficjent")
 */
class BeneficjentController extends Controller
{
    /**
     * Akcja domyślna - wyświetla widok główny lub, 
     * w przypadku gdy użytkownik nie ma profilu beneficjenta
     * na akcję uzupełnij profil
     * 
     * @Route("", name="beneficjent")
     * @return    Response
     */
    public function indexAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();      
        if (!$beneficjent || !$beneficjent->getWypelniony()) {
            return $this->redirectToRoute('beneficjent_uzupelnij');
        }
        $this->getNarzedziaService()->datatableOsoby($this, $beneficjent->getId());        
        $this->getNarzedziaService()->datatableUmowy($this, $beneficjent->getId());   
        
        return $this->render(
            'SsfzBundle:Beneficjent:index.html.twig',
            array(
                'beneficjent' => $beneficjent,
            )
        );
    }
    /**
     * Akcja uzupełnij profil
     * 
     * @Route("/uzupelnij", name="beneficjent_uzupelnij")
     * 
     * @return Response
     */
    public function uzupelnijAction()
    {
        return $this->render('SsfzBundle:Beneficjent:uzupelnij.html.twig');
    }
    /**
     * Akcja edycji profilu beneficjenta
     * 
     * @param Request $request request
     * 
     * @Route("/profil", name="beneficjent_profil") 
     * 
     * @return Response
     */
    public function profilAction(Request $request)
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        if (!$beneficjent) {
            $beneficjent = $this->getBeneficjentService()
                ->addBeneficjent($uzytkownik);
        }
        $originalUmowy = $this->getBeneficjentService()
            ->getBeneficjentUmowy($beneficjent);
        $originalOsoby = $this->getBeneficjentService()
            ->getBeneficjentOsoby($beneficjent);        
        $this->getBeneficjentService()->addUmowaOsobaIfEmpty($beneficjent);
        $form = $this->createForm(BeneficjentType::class, $beneficjent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getBeneficjentService()
                ->updateBeneficjent($beneficjent, $originalUmowy, $originalOsoby);
            $this->addBeneficjentFormSuccessFlash();
            
            return $this->redirectToRoute('beneficjent');
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addBeneficjentFormErrorFlash();
        }
        
        return $this->render(
            'SsfzBundle:Beneficjent:profil.html.twig',
            array(
                'form' => $form->createView(),
            )
        );    
    }
    /**
     * Akcja pobierająca dane do tabeli Osoby zatrudnione
     * 
     * @Route("/gridOsoby", name="datatableOsoby")
     * 
     * @return Response
     */
    public function osobyGridAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();  
        $beneficjentId = $beneficjent->getId();
        
        return $this->getNarzedziaService()
            ->datatableOsoby($this, $beneficjentId)->execute();
    }
    /**
     * Akcja pobierająca dane do tabeli Umowy    
     * 
     * @Route("/gridUmowy", name="datatableUmowy")
     * 
     * @return Response
     */
    public function umowyGridAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();        
        
        return $this->getNarzedziaService()
            ->datatableUmowy($this, $beneficjentId)->execute();
    }            
    /**
     * Pomocnicza metoda 
     * 
     * @return BneficjentService z kontenera
     */
    protected function getBeneficjentService()
    {
        return $this->get('ssfz.service.beneficjent_service');
    }    
    /**
     * Dodaje informację o pomyślnym zapisie danych z formularza
     * 
     * @return void
     */
    protected function addBeneficjentFormSuccessFlash()
    {
        $this->get('session')->getFlashBag()->add(
            'notice', array(
            'alert' => 'success',
            'title' => '',
            'message' => 'Dane zostały zapisane.'
            )
        );
    }
    /**
     * Dodaje informację o nieprawidłowo wypełnionym formularzu
     * 
     * @return void
     */
    protected function addBeneficjentFormErrorFlash()
    {
        $this->get('session')->getFlashBag()->add(
            'notice', array(
            'alert' => 'danger',
            'title' => 'Błąd.',
            'message' => 'Formularz nie został poprawnie wypełniony.'
            )
        );
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
    /**
     * Pobiera serwis NarzedziaService
     * 
     * @return NarzedziaService
     */
    private function getNarzedziaService()
    {
        return $this->get('ssfz.service.narzedzia_service');
    }
}
