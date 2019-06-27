<?php

namespace Parp\SsfzBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Carbon\Carbon;

/**
 * Zadanie CRON do wysyłki powiadomień o niezłożonym sprawozdaniu
 * Wywołanie: php app/console sfz:sendRemind
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
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->dzisiejszaData = new Carbon('Europe/Warsaw');
    }

    /**
     * Konfiguracja zadania
     */
    protected function configure()
    {
        $this
            ->setName('sfz:sendRemind')
            ->setDescription('Wysyłka powiadomień.')
            ->setHelp('This command allows you to create test...')
        ;
    }

    /**
     * Obsługa zadania wysyłki powiadomień
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->pierwszyTermin = new Carbon($this->dzisiejszaData->year . '-' . $this->getContainer()->getParameter('przypomnienie_pierwszy_termin_miesiac_dzien'));
        $this->drugiTermin = new Carbon($this->dzisiejszaData->year . '-' . $this->getContainer()->getParameter('przypomnienie_drugi_termin_miesiac_dzien'));
        $okres = $this->getOkresRozliczenia();
        $rolaBeneficjent = $this->getContainer()->get('ssfz.service.rola_service')->findOneByCriteria(['nazwa' => 'ROLE_BENEFICJENT']);
        $beneficjenciKonta = $this->getContainer()->get('ssfz.service.uzytkownik_service')->findByCriteria(['rola' => $rolaBeneficjent->getId()]);
        
        $czyPierwszyTermin = (0 == $this->dzisiejszaData->diffInDays($this->pierwszyTermin, false));
        $czyDrugiTermin = (0 == $this->dzisiejszaData->diffInDays($this->drugiTermin, false));
        // 9 poziomów wymieszanych IF i FOREACH dla większej szytelności i małej złożoności cyklomatycznej.
        if ($czyPierwszyTermin || $czyDrugiTermin) {
            foreach ($beneficjenciKonta as $beneficjentKonto) {
                foreach ($beneficjentKonto->getBeneficjenci() as $beneficjent) {
                    if (!is_null($beneficjent)) {
                        $umowy = $beneficjent->getUmowy();
                        if (!is_null($umowy)) {
                            foreach ($umowy as $umowa) {

                                // Kod jest całkowicie niejasny. Zaślepka z określaniem na podstawie
                                // pierwszego elementu kolekcji jest tymczasowa, żeby była szansa na zadziałanie.
                                // $czestotliwosc = $umowa->getCzestotliwoscSprawozdanWProgramie();
                                $czestotliwoscPolroczna = $umowa
                                    ->getBeneficjent()
                                    ->getProgram()
                                    ->getOkresySprawozdawcze()
                                    ->first()
                                    ->jestPolroczny()
                                ;

                                // if ($czyPierwszyTermin || $czestotliwosc->czyPolroczna()) {
                                if ($czyPierwszyTermin || $czestotliwoscPolroczna) {
                                    $sprawozdania = $umowa->getSprawozdania();
                                    foreach ($sprawozdania as $sprawozdanie) {
                                        if (is_null($sprawozdanie->getDataPrzeslaniaDoParp())
                                            && !$sprawozdanie->getPowiadomienieWyslane()
                                            && $sprawozdanie->getRok() != $this->dzisiejszaData->year + 1
                                        ) {
                                            $program = $beneficjent->getProgram();
                                            if ($program->czyFunduszPozyczkowy()) {
                                                $sufixPliku = 'pozyczkowy';
                                            } elseif ($program->czyFunduszPoreczeniowy()) {
                                                $sufixPliku = 'poreczeniowy';
                                            } else {
                                                $sufixPliku = 'zalazkowy';
                                            }

                                            $nrUmowy = $umowa->getNumer();
                                            $template = 'SsfzBundle:Email:remindUnsubmittedReport.'
                                                . $sufixPliku
                                                . '.html.twig'
                                            ;
                                            $templateParams = array(
                                                'nrUmowy' => $nrUmowy,
                                                'dzien' => $this->dzisiejszaData->format('Y-m-d')
                                            );
                                            $this->getMailerService()->sendMailTopicInTemplate($beneficjentKonto, $template, $templateParams);
                                            $sprawozdanie->setPowiadomienieWyslane(true);
                                            $this->getSprawozdanieRepository()->persist($sprawozdanie);
                                            if (!isset($this->beneficjenciZalegajacy[$sufixPliku])) {
                                                $this->beneficjenciZalegajacy[$sufixPliku] = [];
                                            }
                                            array_push(
                                                $this->beneficjenciZalegajacy[$sufixPliku],
                                                array($umowa->getNumer(), $beneficjent)
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            foreach ($this->beneficjenciZalegajacy as $sufixPliku => $beneficjenciZalegajacy) {
                if (!empty($beneficjenciZalegajacy)) {
                    $template = '@SsfzBundle/Resources/views/Email/unsubmittedReport.'
                        . $sufixPliku
                        . '.html.twig'
                    ;
                    $templateParams = array(
                        'dzien' => $this->dzisiejszaData,
                        'okres' => $okres,
                        'beneficjenciZalegajacy' => $beneficjenciZalegajacy
                    );
                    $this
                        ->getMailerService()
                        ->sendMailToGroupTopicInTemplate(
                            $this->getUzytkownikRepository()->getPracownicyAdresyEmailArray(),
                            $template,
                            $templateParams
                        )
                    ;
                }
            }
        }
    }

    /**
     * Zwraca okres rozliczenia
     *
     * @return string
     */
    private function getOkresRozliczenia()
    {
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
    protected function getMailerService()
    {
        return $this->getContainer()->get('ssfz.service.mailer_service');
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

    /**
     * Metoda pobierająca repozytorium użytkowników
     *
     * @return SprawozdanieRepository
     */
    protected function getUzytkownikRepository()
    {
        return $this->getContainer()->get('ssfz.service.uzytkownik_service')->getUzytkownikRepository();
    }
}
