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
     * Metoda kierująca użytkowników na odpowiednią część systemu,
     * zgodnie z rolą uwierzytelnionego użytkownika
     *
     * @Route(path = "/", name="default")
     *
     * @return Response
     */
    public function indexAction()
    {
        $rola = $this->get('security.authorization_checker');
        if ($rola->isGranted('ROLE_BENEFICJENT')) {
            return $this->redirectToRoute('beneficjent');
        } else if ($rola->isGranted('ROLE_ADMINISTRATOR_TECHNICZNY')) {
            return $this->redirectToRoute('administrator');
        } else if ($rola->isGranted('ROLE_PRACOWNIK_PARP') || $rola->isGranted('ROLE_KOORDYNATOR_MERYTORYCZNY')) {
            return $this->redirectToRoute('parp');
        }

        return $this->render('SsfzBundle:Default:index.html.twig');
    }
}
