<?php
namespace Parp\SsfzBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;

/**
 * Zadanie CRON do wysyłki powiadomień o niezłożonym sprawozdaniu
 *
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class SprawozdaniePrzypomnienieCommand extends ContainerAwareCommand
{

    /**
     *
     * @var Carbon\Carbon
     */
    private $dzisiejszaData;

    /**
     * @var Carbon\Carbon
     */
    private $pierwszyTermin;

    /**
     * @var Carbon\Carbon
     */
    private $drugiTermin;

    /**
     * Kontstruktor
     *
     * @param string $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->dzisiejszaData = new Carbon('Europe/Warsaw');
        $this->pierwszyTermin = new Carbon($this->dzisiejszaData->year . '-02-14');
        $this->drugiTermin = new Carbon($this->dzisiejszaData->year . '-08-14');
    }

    /**
     * Konfiguracja zadania
     */
    protected function configure()
    {
        $this
            ->setName('sfz:sendRemind')
            ->setDescription('Wysyłka powiadomień.')
            ->setHelp('This command allows you to create test...');
    }

    /**
     * Obsługa zadania wysyłki powiadomień
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $uzytkownikRepository = $this->getUzytkownikRepository();
        $rolaRepository = $this->getRolaRepository();

        $okres = 'lipiec - grudzień';

        if ($this->dzisiejszaData->month < 7) {
            $okres = 'styczeń – czerwiec';
        }

        $beneficjenciKonta = $uzytkownikRepository->findBy(['rola' => $rolaRepository->findOneBy(['nazwa' => 'ROLE_BENEFICJENT'])->getId()]);
        $topic = 'Nie odnotowano złożenia sprawozdania z realizowanego projektu w ramach Działania 3.1 PO IG';
        $beneficjenciZalegajacy = array();
        $messages = array();
        if ($this->dzisiejszaData->diffInDays($this->pierwszyTermin, false) == 0 
            || $this->dzisiejszaData->diffInDays($this->drugiTermin, false) == 0
        ) {
            foreach ($beneficjenciKonta as $beneficjentKonto) {
                $beneficjent = $beneficjentKonto->getBeneficjent();
                if (!is_null($beneficjent)) {
                    $umowy = $beneficjent->getUmowy();
                    if (!is_null($umowy)) {
                        foreach ($umowy as $umowa) {
                            $sprawozdania = $umowa->getSprawozdania();
                            foreach ($sprawozdania as $sprawozdanie) {
                                if ($sprawozdanie->getDataPrzeslaniaDoParp() == null 
                                    && !$sprawozdanie->getPowiadomienieWyslane()
                                ) {

                                    $nrUmowy = $umowa->getNumer();

                                    $template = '@SsfzBundle/Resources/views/Email/remindUnsubmittedReport.html.twig';
                                    $templateParams = array(
                                        'nrUmowy' => $nrUmowy,
                                        'dzien' => $this->dzisiejszaData
                                    );

                                    $this->getMailerService()->sendMail($beneficjentKonto, $topic, $template, $templateParams);
                                    $sprawozdanie->setPowiadomienieWyslane(true);
                                    $this->getSprawozdanieRepository()->persist($sprawozdanie);

                                    array_push($beneficjenciZalegajacy, $beneficjent);
                                }
                            }
                            //$terminZlozenia = new Carbon($sprawozdanie->getDataPrzeslaniaDoParp()->format('Y-m-d H:i:s'));
                        }
                    }
                }
            }
        }
        $topic = 'Lista Beneficjentów Działania 3.1 zalegających ze złożeniem sprawozdania za okres ' . $okres;

        $template = '@SsfzBundle/Resources/views/Email/unsubmittedReport.html.twig';
        $templateParams = array(
            'dzien' => $this->dzisiejszaData,
            'okres' => $okres,
            'beneficjenciZalegajacy' => $beneficjenciZalegajacy
        );
        $this->getMailerService()->sendMailToGroup($uzytkownikRepository->getPracownicyAdresyEmailArray(), $topic, $template, $templateParams);
    }

    /**
     * Załadowanie serwisu MailerService
     * odpowiedzialnego za wysyłkę powiadomień
     *
     * @return MailerService
     */
    protected function getMailerService()
    {
        return $this->getContainer()->get('ssfz.service.mailer_service');
    }

    /**
     * Metoda pobierająca repozytorium użytkownika
     *
     * @return UzytkownikRepository
     */
    protected function getUzytkownikRepository()
    {
        return $this->getContainer()->get('ssfz.service.uzytkownik_service')->getUzytkownikRepository();
    }

    /**
     * Metoda pobierająca repozytorium ról
     *
     * @return RolaRepository
     */
    protected function getRolaRepository()
    {
        return $this->getContainer()->get('ssfz.service.uzytkownik_service')->getRolaRepository();
    }

    /**
     * Metoda pobierająca repozytorium sprawozdzań
     *
     * @return SprawozdanieRepository
     */
    protected function getSprawozdanieRepository()
    {
        return $this->getContainer()->get('ssfz.service.sprawozdanie_service')->getSprawozdanieRepository();
    }
}
