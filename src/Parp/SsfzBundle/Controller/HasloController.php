<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Form\Type\ResetLinkType;
use Parp\SsfzBundle\Form\Model\ResetLink;
use Parp\SsfzBundle\Form\Type\ResetPasswordType;
use Parp\SsfzBundle\Form\Type\ChangePasswordType;
use Parp\SsfzBundle\Form\Model\ChangePassword;

/**
 * Kontroler obsługujący funkcjonalności 
 * związane z modyfikacjami hasła
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 * 
 * @Route("/haslo")
 */
class HasloController extends Controller
{

    /**
     * Metoda do wygenerowania klucza zmiany kasła.
     * Wysyłka klucza resetującego hasło na podany adres email.
     * 
     * @Route("/przypomnij", name="przypomnienie_hasla")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function recoverPassword(Request $request)
    {
        $resetLink = new ResetLink();
        $form = $this->createForm(new ResetLinkType(), $resetLink);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resetLink = $form->getData();
            $uzytkownikService = $this->get('ssfz.service.uzytkownik_service');
            $uzytkownik = $uzytkownikService->findOneByCriteria(['login' => $resetLink->getLogin(), 'email' => $resetLink->getEmail()]);
            if (!is_null($uzytkownik)) {
                if (0 === $uzytkownik->getStatus()) {
                    return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Konto nie zostało aktywowane. Skorzystaj z linku aktywacyjnego przesłanego na adres mailowy podany przy zakładaniu konta.'));
                }
                $uzytkownikService->forgottenPassword($uzytkownik);
                $this->getMailerService()->sendMail($uzytkownik, 'Zmiana hasła', '@SsfzBundle/Resources/views/Email/resetPassword.html.twig', array('code' => $uzytkownik->getKodZapomnianeHaslo(), 'login' => $resetLink->getLogin()));

                return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array(
                        'info' => 'Wysłano link zmiany hasła na adres email ' . $uzytkownik->getEmail() . '. Na twojej skrzynce mailowej znajdują się dalsze instrukcje, które umożliwią odzyskanie hasła do konta.')
                );
            }

            return $this->render('SsfzBundle:Security:passwordRecover.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Konto nie istnieje w systemie.'
                    )
            );
        }

        return $this->render('SsfzBundle:Security:passwordRecover.html.twig', array(
                'form' => $form->createView(),
                'error' => ''
                )
        );
    }

    /**
     * Medota do resetu hasła.
     * 
     * @Route("/reset/token={token}")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        $resetPassword = new ChangePassword();
        $form = $this->createForm(new ResetPasswordType(), $resetPassword);
        $form->handleRequest($request);
        $token = $request->get('token');
        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownikService = $this->get('ssfz.service.uzytkownik_service');
            $uzytkownik = $uzytkownikService->findOneByCriteria(['kodZapomnianeHaslo' => $token]);
            if (is_null($uzytkownik)) {
                return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Link do zmiany hasła został użyty i stracił ważność.'));
            }
            $resetPassword = $form->getData();
            $uzytkownikService->newPassword($uzytkownik, $resetPassword->getNewPassword());

            return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Hasło zostało zmienione, zaloguj się do serwisu.'));
        }

        return $this->render('SsfzBundle:Security:passwordReset.html.twig', array(
                'form' => $form->createView(),
                'error' => '',
                'title' => 'Odzyskiwanie hasła',
                'submitButtonName' => 'Zapisz'
                )
        );
    }

    /**
     * Metoda do zmiany hasła.
     * 
     * @Route("/zmiana")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $resetPassword = new ChangePassword();
        $form = $this->createForm(new ChangePasswordType(), $resetPassword);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownikService = $this->get('ssfz.service.uzytkownik_service');
            $resetPassword = $form->getData();
            $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
            $haslo = password_hash($resetPassword->getNewPassword(), PASSWORD_BCRYPT, array('cost' => 12));
            if (password_verify($resetPassword->getOldPassword(), $uzytkownik->getHaslo())) {
                $uzytkownikService->newPassword($uzytkownik, $resetPassword->getNewPassword());
                $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Hasło zostało zmienione.');

                return $this->redirect(($this->generateUrl('default')));
            }

            return $this->render('SsfzBundle:Security:passwordReset.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Aktualne hasło nie zgadza się.',
                    'title' => 'Zmiana hasła',
                    'submitButtonName' => 'Zmień hasło'
                    )
            );
        }

        return $this->render('SsfzBundle:Security:passwordReset.html.twig', array(
                'form' => $form->createView(),
                'error' => '',
                'title' => 'Zmiana hasła',
                'submitButtonName' => 'Zmień hasło'
                )
        );
    }

    /**
     * Załadowanie serwisu MailerService
     * odpowiedzialnego za wysyłkę powiadomień
     * 
     * @return MailerService
     */
    protected function getMailerService()
    {
        return $this->get('ssfz.service.mailer_service');
    }
}
