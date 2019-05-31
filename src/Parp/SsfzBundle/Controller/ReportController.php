<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Kontroler obsługujący raportowanie
 *
 * @Route("/parp/raporty", name="raporty")
 */
class ReportController extends Controller
{
    /**
     * Wyświetlanie widoku raportów
     *
     * @Route("", name="raporty")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('SsfzBundle:Report:indexJasper.html.twig', array(
                'reports' => $this->get('ssfz.service.jasperreports_service')->listAllReports())
        );
    }

    /**
     * Odwołanie do metody serwisu JasperReportsService
     * umożliwiającej pobranie raportu
     *
     * @Route("/pobierz", name="pobierz")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function reportAction(Request $request)
    {
        return $this->get('ssfz.service.jasperreports_service')->getReport($request->get('uri'));
    }
}
