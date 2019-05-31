<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Entity\Uzytkownik;
use Jaspersoft\Client\Client;
use Jaspersoft\Service\Criteria\RepositorySearchCriteria;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serwis obsługujący raportowanie JasperReports
 */
class JasperReportsService
{
    /**
     *
     * @var Client
     */
    private $client;

    /**
     *
     * @var string
     */
    private $reportsPath;

    /**
     * Konstruktor
     *
     * Tworzone jest połączenie z JasperReports server
     * Określana jest ścieżka główna, pod którą
     * znajdują się pliki raportów
     *
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $org
     * @param string $reportsPath
     */
    public function __construct($host, $user, $password, $org, $reportsPath)
    {
        $this->client = new Client($host, $user, $password, $org);
        $this->reportsPath = $reportsPath;
    }

    /**
     * Zwraca listę dostępnych raportów,
     * znajdujących się pod ścieżką, zdefiniowaną
     * w pliku parameters.yml
     *
     * @return array
     */
    public function listAllReports()
    {
        $criteria = new RepositorySearchCriteria();
        $criteria->folderUri = $this->reportsPath;

        return $this->client->repositoryService()->searchResources($criteria)->items;
    }

    /**
     * Metoda umożliwiająca pobranie pliku
     * raportu w formacie xls
     *
     * @param  string $filePath
     * @return Response
     */
    public function getReport($filePath)
    {
        $response = new Response($this->client->reportService()->runReport($filePath, 'xls'));
        $response->headers->set('Content-type', 'application/excel');
        $response->headers->set('Content-Disposition', 'inline; filename=Raport.xls');
        $response->headers->set('Cache-Control', 'must-revalidate');

        return $response;
    }
}
