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
        $this->get('ssfz.service.datatable_osoby_service')->datatableOsoby($this, $beneficjent->getId());        
        $this->get('ssfz.service.datatable_umowy_service')->datatableUmowy($this, $beneficjent->getId());   
        
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
            if ($form->isValid()) {
                $this->getBeneficjentService()
                    ->updateBeneficjent($beneficjent, $originalUmowy, $originalOsoby);
                $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Dane zostały zapisane.');
            
                return $this->redirectToRoute('beneficjent');
            } else {
                $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Formularz nie został poprawnie wypełniony.');
            }
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
        
        return $this->get('ssfz.service.datatable_osoby_service')
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
        
        return $this->get('ssfz.service.datatable_umowy_service')
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
     * Pobiera zalogowanego użytkownika
     * 
     * @throws AccessDeniedException
     * 
     * @return Uzytkownik
     */
    protected function getZalogowanyUzytkownik()
    {
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        if (null == $uzytkownik) {
            throw $this->createAccessDeniedException();
        }        
        
        return $uzytkownik;
    }      
}
