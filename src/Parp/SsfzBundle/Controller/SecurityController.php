<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\{
    Request,
    RedirectResponse
};

/**
 * Kontroler obsługujący funkcjonalności po stronie Użytkownika
 */
class SecurityController extends Controller
{
    /**
     * Metoda wyświetlająca formularz logowania
     *
     * @Route("/login", name="login")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function loginAction(Request $request): Response
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();

        return $this->render('SsfzBundle::Security/loginForm.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            'error'         => $error,
        ]);
    }

    /**
     * Operacje wykonywane przed wylogowaniem użytkownika.
     *
     * @Route("/wyloguj", name="wyloguj")
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function wylogujAction(Request $request): RedirectResponse
    {
        $this
            ->getUser()
            ->eraseCredentials()
        ;
        $this
            ->getDoctrine()
            ->getManager()
            ->flush()
        ;

        $session = $request->getSession();
        $session->invalidate();

        return $this->redirectToRoute('logout');
    }
}
