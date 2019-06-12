<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Kontroler główny
 */
class DefaultController extends Controller
{
    /**
     * Przekierowuje użytkownika do właściwej dla jego roli część aplikacji.
     *
     * @Route(path = "/", name="default")
     *
     * @return Response
     */
    public function indexAction()
    {
        $role = $this->get('security.authorization_checker');

        if ($role->isGranted('ROLE_BENEFICJENT')) {
            return $this->redirectToRoute('beneficjent');
        }

        if ($role->isGranted('ROLE_ADMINISTRATOR_TECHNICZNY')) {
            return $this->redirectToRoute('administrator');
        }

        if ($role->isGranted('ROLE_PRACOWNIK_PARP') || $role->isGranted('ROLE_KOORDYNATOR_MERYTORYCZNY')) {
            return $this->redirectToRoute('parp');
        }

        return $this->render('SsfzBundle:Default:index.html.twig');
    }
}
