<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Kontroler obsługujący funkcjonalności po stronie Użytkownika
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class SecurityController extends Controller
{

    /**
     * Metoda wyświetlająca formularz logowania
     * 
     * @see https://symfony.com/doc/current/security/form_login_setup.html
     * 
     * @Route("/login", name="login")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();

        return $this->render('SsfzBundle::Security/loginForm.html.twig', array(
                'last_username' => $authUtils->getLastUsername(),
                'error' => $error,
                )
        );
    }
}
