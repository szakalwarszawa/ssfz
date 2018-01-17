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
class SprawozdaniePrzypomnienieCommand extends ContainerAwareCommand {

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
     *
     * @var array
     */
    private $beneficjenciZalegajacy = array();

    /**
     * Kontstruktor
     * 
     * Ustawiane są daty:
     * dzisiejsza,
     * pierwszego terminu rozliczenia ze złożenia sprawozdzania,
     * drugiego terminu rozliczenia ze złożenia sprawozdania
     * 
     * @param string $name
     */
    public function __construct($name = null) {
        parent::__construct($name);
        $this->dzisiejszaData = new Carbon('Europe/Warsaw');
    }

    /**
     * Konfiguracja zadania
     */
    protected function configure() {
        $this->setName('sfz:sendRemind')
                ->setDescription('Wysyłka powiadomień.')
                ->setHelp('This command allows you to create test...');
    }

    /**
     * Obsługa zadania wysyłki powiadomień
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->pierwszyTermin = new Carbon($this->dzisiejszaData->year . '-' . $this->getContainer()->getParameter('przypomnienie_pierwszy_termin_miesiac_dzien'));
        $this->drugiTermin = new Carbon($this->dzisiejszaData->year . '-' . $this->getContainer()->getParameter('przypomnienie_drugi_termin_miesiac_dzien'));
        $okres = $this->getOkresRozliczenia();
        $rolaBeneficjent = $this->getContainer()->get('ssfz.service.rola_service')->findOneByCriteria(['nazwa' => 'ROLE_BENEFICJENT']);
        $beneficjenciKonta = $this->getContainer()->get('ssfz.service.uzytkownik_service')->findByCriteria(['rola' => $rolaBeneficjent->getId()]);
        $topic = 'Nie odnotowano złożenia sprawozdania z realizowanego projektu w ramach Działania 3.1 PO IG';
        if (0 == $this->dzisiejszaData->diffInDays($this->pierwszyTermin, false) || 0 == $this->dzisiejszaData->diffInDays($this->drugiTermin, false)) {
            foreach ($beneficjenciKonta as $beneficjentKonto) {
                $beneficjent = $beneficjentKonto->getBeneficjent();
                if (!is_null($beneficjent)) {
                    $umowy = $beneficjent->getUmowy();
                    if (!is_null($umowy)) {
                        foreach ($umowy as $umowa) {
                            $sprawozdania = $umowa->getSprawozdania();
                            foreach ($sprawozdania as $sprawozdanie) {
                                if (is_null($sprawozdanie->getDataPrzeslaniaDoParp()) && !$sprawozdanie->getPowiadomienieWyslane() && $sprawozdanie->getRok() != $this->dzisiejszaData->year + 1) {
                                    $nrUmowy = $umowa->getNumer();
                                    $template = '@SsfzBundle/Resources/views/Email/remindUnsubmittedReport.html.twig';
                                    $templateParams = array(
                                        'nrUmowy' => $nrUmowy,
                                        'dzien' => $this->dzisiejszaData
                                    );
                                    $this->getMailerService()->sendMail($beneficjentKonto, $topic, $template, $templateParams);
                                    $sprawozdanie->setPowiadomienieWyslane(true);
                                    $this->getSprawozdanieRepository()->persist($sprawozdanie);
                                    array_push($this->beneficjenciZalegajacy, array($umowa->getNumer(), $beneficjent));
                                }
                            }
                        }
                    }
                }
            }
            if(!empty($this->beneficjenciZalegajacy)) {
                $topic = 'Lista Beneficjentów Działania 3.1 zalegających ze złożeniem sprawozdania za okres ' . $okres;
                $template = '@SsfzBundle/Resources/views/Email/unsubmittedReport.html.twig';
                $templateParams = array(
                    'dzien' => $this->dzisiejszaData,
                    'okres' => $okres,
                    'beneficjenciZalegajacy' => $this->beneficjenciZalegajacy
                );
                $this->getMailerService()->sendMailToGroup($this->getUzytkownikRepository()->getPracownicyAdresyEmailArray(), $topic, $template, $templateParams);
            }
        }
    }

    /**
     * Zwraca okres rozliczenia
     * 
     * @return string
     */
    private function getOkresRozliczenia() {
        $okres = 'lipiec - grudzień';
        if ($this->dzisiejszaData->month < 7) {
            $okres = 'styczeń – czerwiec';
        }

        return $okres;
    }

    /**
     * Załadowanie serwisu MailerService
     * odpowiedzialnego za wysyłkę powiadomień
     *
     * @return MailerService
     */
    protected function getMailerService() {
        return $this->getContainer()->get('ssfz.service.mailer_service');
    }

    /**
     * Metoda pobierająca repozytorium sprawozdzań
     *
     * @return SprawozdanieRepository
     */
    protected function getSprawozdanieRepository() {
        return $this->getContainer()->get('ssfz.service.sprawozdanie_service')->getSprawozdanieRepository();
    }

    /**
     * Metoda pobierająca repozytorium użytkowników
     *
     * @return SprawozdanieRepository
     */
    protected function getUzytkownikRepository() {
        return $this->getContainer()->get('ssfz.service.uzytkownik_service')->getUzytkownikRepository();
    }

}
