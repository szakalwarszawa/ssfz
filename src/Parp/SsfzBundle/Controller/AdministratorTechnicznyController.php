<?php

namespace Parp\SsfzBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Parp\SsfzBundle\Entity\Rola;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Form\Type\PracownikParpEdycjaType;
use Parp\SsfzBundle\Form\Type\PracownikParpRejestracjaType;
use Parp\SsfzBundle\Exception\LdapDataServiceException;

/**
 * Kontroler obsługujący funkcjonalności po stronie Użytkownika z rolą administrator techniczny
 */
class AdministratorTechnicznyController extends Controller
{
    /**
     * Akcja domyślna - wyświetla widok główny.
     *
     * @Route("/administrator", name="administrator")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('SsfzBundle:AdministratorTechniczny:index.html.twig');
    }

    /**
     * Akcja wyświetlająca formularz i tworzaca nowego użytkownika na podstawie
     * danych z katalogu LDAP (pracowników PARP)
     *
     * @param Request $request
     *
     * @Route("administrator/pracownik/utworz", name="utworzPracownika")
     *
     * @return Response
     */
    public function utworzPracownikaAction(Request $request)
    {
        $pracownicy = $this->pobierzPracownikow();

        $ldapDataService = $this->get('ssfz.service.ldap_data_service');
        $uzytkRepo = $this->getDoctrine()->getRepository(Uzytkownik::class);

        $form = $this->createForm(PracownikParpRejestracjaType::class, [], [
            'ssfz.service.ldap_data_service' => $ldapDataService,
            'uzytk_repo'                     => $uzytkRepo,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dane = $form->getData();

            $pracownik = $this->utworzPracownika($dane);
            if (null === $pracownik) {
                $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Utworzenie konta pracownika nie powiodło się.');

                return $this->redirectToRoute('utworzPracownika');
            }
            $this->persistPracownik($pracownik);
            $this->wyslijWiadomoscAktywacyjna($pracownik);
            $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Konto pracownika zostało utworzone poprawnie. Link aktywacyjny został wyslany na adres e-mail pracownika.');

            return $this->redirectToRoute('utworzPracownika');
        }

        return $this->render('SsfzBundle:AdministratorTechniczny:utworzPracownika.html.twig', [
            'form'                   => $form->createView(),
            'dostepniPracownicyParp' => count($ldapDataService->getUzytkownikLdapListaZEmail()) > 0,
            'przegladPracownikow'    => $pracownicy
        ]);
    }

    /**
     * Akcja wyświetlająca formularz edycji użytkownika i zmieniająca dane użytkownika
     * na podstawie danych z tego formularza
     *
     * @Route("administrator/pracownik/edytuj/{id_uzytkownika}", name="edytujPracownika")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function edytujPracownika(Request $request)
    {
        $uzytkRepo = $this->getDoctrine()->getRepository(Uzytkownik::class);
        $uzytkId = $request->get('id_uzytkownika');
        $uzytkownik = $uzytkRepo->find($uzytkId);
        $komunikat = $this->edycjaUzytkownikPoprawnyKomunikat($uzytkownik);
        if (null !== $komunikat) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat($komunikat);

            return $this->redirectToRoute('utworzPracownika');
        }
        $form = $this->createForm(PracownikParpEdycjaType::class, $uzytkownik, [
            'uzytk_repo' => $uzytkRepo,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pracownik = $form->getData();
            $this->persistPracownik($pracownik);
            $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Dane pracownika zostały zaktualizowane.');

            return $this->redirectToRoute('utworzPracownika');
        }

        return $this->render('SsfzBundle:AdministratorTechniczny:edytujPracownika.html.twig', array('form' => $form->createView()));
    }

    /**
     * Tworzy nowego użytkownika - pracownika PARP
     *
     * Tworzy nowe konto użytkownika - pracownika PARP na podstawie danych z formularza i LDAP.
     * Wypełnia obiekt kodem aktywacyjnym i ustawia rolę
     *
     * @param  array $dane dane z formularza musi zawierać pole: login z loginem pracownika i rola z Rola
     *
     * @return Uzytkownik użytkownik wypełniony danycmi z formularza i LDAP
     */
    private function utworzPracownika($dane)
    {
        $pracownik = $this->utworzPracownikaZDanychILdap($dane);
        if (null === $pracownik) {
            return null;
        }
        $randomHash = base64_encode(random_bytes(64));
        $randomHash = str_replace(array('/', '+', '='), '', $randomHash);
        $pracownik->setKodAktywacjaKonta($randomHash);
        $pracownik->setRola($dane['rola']);

        return $pracownik;
    }

    /**
     * Dodaje nowego użytkownika do bazy
     *
     * @param Uzytkownik $pracownik
     */
    private function persistPracownik($pracownik)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;
        $entityManager->persist($pracownik);
        $entityManager->flush();
    }

    /**
     * Tworzy obiekt pracownika na podstawie danych z formularza i LDAP
     *
     * @param array $dane dane z formularza powinny miec pole login z loginem uzytkownika
     *
     * @return Uzytkownik
     */
    private function utworzPracownikaZDanychILdap($dane)
    {

        $login = $dane['login'];
        $ldapUsluga = $this->get('ssfz.service.ldap_data_service');
        try {
            $uzytkownikLdap = $ldapUsluga->getUzytkownikLdap($login);
        } catch (LdapDataServiceException $e) {
            return null;
        }
        $uzytkownik = new Uzytkownik();
        $uzytkownik->setLogin($login);
        $uzytkownik->setImie($uzytkownikLdap->getImie());
        $uzytkownik->setNazwisko($uzytkownik->getNazwisko());
        $uzytkownik->setEmail($uzytkownikLdap->getEmail());
        $uzytkownik->setStatus(0);

        return $uzytkownik;
    }

    /**
     * Wysyła wiadomość aktywacyjną do podanego użytkownika
     *
     * Treść wiadomości jest tworzona na podstawie szablonu:
     * SsfzBundle/Resources/views/Email/registrationPracownikParp.html.twig
     *
     * @param Uzytkownik $pracownik
     */
    private function wyslijWiadomoscAktywacyjna(Uzytkownik $pracownik)
    {
        $topic = 'Utworzono konto';
        $template = '@SsfzBundle/Resources/views/Email/registrationPracownikParp.html.twig';
        $templateParams = array(
            'code' => $pracownik->getKodAktywacjaKonta(),
            'login' => $pracownik->getLogin());
        $this->getMailerService()->sendMail($pracownik, $topic, $template, $templateParams);
    }

    /**
     * Pobiera wykaz pracowników.
     *
     * @return array
     */
    private function pobierzPracownikow()
    {
        $rolePracownikow = Rola::NAZWY_ROL_PARP;
        $rolaRepo = $this
            ->getDoctrine()
            ->getRepository(Rola::class)
        ;

        return $this
            ->getDoctrine()
            ->getRepository(Uzytkownik::class)
            ->znajdzPoRolach($rolaRepo->znajdzPoNazwach($rolePracownikow))
        ;
    }

    /**
     * Załadowanie serwisu MailerService odpowiedzialnego za wysyłkę powiadomień
     *
     * @return MailerService
     */
    protected function getMailerService()
    {
        return $this->get('ssfz.service.mailer_service');
    }

    /**
     * Sprawdza czy użytkownik przeznaczony do edycji jest poprawny
     *
     * Użytkownik powinien byc not null i mieć role pracownika PARP
     *
     * @param  Uzytkownik $uzytkownik użytkownik do zweryfikowania
     *
     * @return string komunikat błedu lub null jesli wszystko ok
     */
    private function edycjaUzytkownikPoprawnyKomunikat(Uzytkownik $uzytkownik)
    {
        if (null === !$uzytkownik) {
            return 'Użytkownik nie istnieje';
        }
        if (!$uzytkownik->czyPracownikParp()) {
            return 'Edytowany uzytkownik nie jest Pracownikiem PARP';
        }

        return null;
    }
}
