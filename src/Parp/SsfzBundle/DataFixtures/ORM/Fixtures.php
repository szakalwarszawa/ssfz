<?php
namespace Ssfz\DataFixtures\ORM;

use Parp\SsfzBundle\Entity\Rola;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\BeneficjentFormaPrawna;
use Parp\SsfzBundle\Entity\Wojewodztwo;
use Parp\SsfzBundle\Entity\GospodarkaDzial;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Spolka;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Seeder danych testowych
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class Fixtures implements FixtureInterface
{

    /**
     * Załadowanie danych do bazy
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $rolaKoordynatorTechniczny = new Rola;
        $rolaKoordynatorTechniczny->setNazwa('ROLE_KOORDYNATOR_TECHNICZNY');
        $rolaKoordynatorTechniczny->setOpis('Administrator techniczny');

        $rolaKoordynatorMerytoryczny = new Rola;
        $rolaKoordynatorMerytoryczny->setNazwa('ROLE_KOORDYNATOR_MERYTORYCZNY');
        $rolaKoordynatorMerytoryczny->setOpis('Administrator merytoryczny');

        $rolaPracownikParp = new Rola;
        $rolaPracownikParp->setNazwa('ROLE_PRACOWNIK_PARP');
        $rolaPracownikParp->setOpis('Pracownik PARP');

        $rolaBeneficjent = new Rola;
        $rolaBeneficjent->setNazwa('ROLE_BENEFICJENT');
        $rolaBeneficjent->setOpis('Beneficjent');

        $manager->persist($rolaKoordynatorTechniczny);
        $manager->persist($rolaKoordynatorMerytoryczny);
        $manager->persist($rolaPracownikParp);
        $manager->persist($rolaBeneficjent);
        $manager->flush();

        $fakePassword = 'domyslne_haslo';

        $userKoordynatorTechniczny = new Uzytkownik();
        $userKoordynatorTechniczny->setLogin('admin');
        $userKoordynatorTechniczny->setHaslo($fakePassword);
        $userKoordynatorTechniczny->setEmail('email@example.com');
        $userKoordynatorTechniczny->setRola($rolaKoordynatorTechniczny);
        $manager->persist($userKoordynatorTechniczny);

        $manager->flush();

        $userKoordynatorTechniczny->setStatus(1);
        $manager->persist($userKoordynatorTechniczny);

        $manager->flush();

        $userBeneficjentPass = 'Zeto#2017!';
        $userBeneficjent = new Uzytkownik();
        $userBeneficjent->setLogin('bzk777');
        $userBeneficjent->setHaslo($userBeneficjentPass);
        $userBeneficjent->setEmail('beneficjent@example.com');
        $userBeneficjent->setRola($rolaBeneficjent);
        $manager->persist($userBeneficjent);
        $manager->flush();
        $userBeneficjent->setStatus(1);
        $manager->persist($userBeneficjent);
        $manager->flush();
        
        $userParpPass = 'Zeto#2017!';
        $userParp = new Uzytkownik();
        $userParp->setLogin('bzk666');
        $userParp->setHaslo($userParpPass);
        $userParp->setEmail('parp@example.com');
        $userParp->setRola($rolaPracownikParp);
        $manager->persist($userParp);
        $manager->flush();
        $userParp->setStatus(1);
        $manager->persist($userParp);
        $manager->flush();          
        
        $okresyKonfiguracja = new OkresyKonfiguracja();
        $okresyKonfiguracja->setRok(2016);
        $okresyKonfiguracja->setO1u(0);
        $okresyKonfiguracja->setO2u(0);
        $manager->persist($okresyKonfiguracja);
        $manager->flush();
        
        $okresyKonfiguracja = new OkresyKonfiguracja();
        $okresyKonfiguracja->setRok(2017);
        $okresyKonfiguracja->setO1u(0);
        $okresyKonfiguracja->setO2u(0);
        $manager->persist($okresyKonfiguracja);
        $manager->flush();

        $okresyKonfiguracja = new OkresyKonfiguracja();
        $okresyKonfiguracja->setRok(2018);
        $okresyKonfiguracja->setO1u(0);
        $okresyKonfiguracja->setO2u(0);
        $manager->persist($okresyKonfiguracja);
        $manager->flush();

        $okresyKonfiguracja = new OkresyKonfiguracja();
        $okresyKonfiguracja->setRok(2019);
        $okresyKonfiguracja->setO1u(0);
        $okresyKonfiguracja->setO2u(0);
        $manager->persist($okresyKonfiguracja);
        $manager->flush();        
        
        $beneficjentKonto = new Beneficjent();
        $beneficjentKonto->setNazwa('BeneficjentTestowy');
        $beneficjentKonto->setAdrWojewodztwo('podlaskie');
        $beneficjentKonto->setAdrMiejscowosc('MiejscowoscTest');
        $beneficjentKonto->setAdrUlica('UlicaTest');
        $beneficjentKonto->setAdrBudynek('1'); 
        $beneficjentKonto->setAdrLokal('1');
        $beneficjentKonto->setAdrKod('11-111');
        $beneficjentKonto->setAdrPoczta('PocztaTest');
        $beneficjentKonto->setTelStacjonarny('123456789');
        $beneficjentKonto->setTelKomorkowy('123456789');
        $beneficjentKonto->setEmail('test@test.pl');
        $beneficjentKonto->setFax('123456789');
        $beneficjentKonto->setWypelniony('1');
        $manager->persist($beneficjentKonto);
        $manager->flush();
                
        $userBeneficjent->setBeneficjent($beneficjentKonto);
        $manager->persist($userBeneficjent);
        $manager->flush();        
        
        $umowa = new Umowa();
        $umowa->setNumer('123456');
        $umowa->setBeneficjent($beneficjentKonto);
        $manager->persist($umowa);
        $manager->flush();        
        $spolka = new Spolka();
        $spolka->setUmowa($umowa);
        $manager->persist($spolka);
        $manager->flush();          
        
        $sprawozdanie = new Sprawozdanie();
        $sprawozdanie->setUmowa($umowa);
        $sprawozdanie->setCreatorId($userBeneficjent->getId());
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $sprawozdanie->setDataRejestracji($value);
        $sprawozdanie->setNumerUmowy($umowa->getNumer());
        $sprawozdanie->setOkres('styczeń - czwerwiec');
        $sprawozdanie->setOkresId(0);
        $sprawozdanie->setRok(2016);
        $sprawozdanie->setStatus(2);
        $sprawozdanie->setWersja(1);
        $sprawozdanie->setCzyNajnowsza(1);
        $manager->persist($sprawozdanie);
        $manager->flush();    
        
        $sprawozdanie2 = new Sprawozdanie();
        $sprawozdanie2->setUmowa($umowa);
        $sprawozdanie2->setCreatorId($beneficjentKonto->getId());
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $sprawozdanie2->setDataRejestracji($value);
        $sprawozdanie2->setNumerUmowy($umowa->getNumer());
        $sprawozdanie2->setOkres('styczeń - czwerwiec');
        $sprawozdanie2->setOkresId(0);
        $sprawozdanie2->setRok(2017);
        $sprawozdanie2->setStatus(1);
        $sprawozdanie2->setWersja(1);
        $sprawozdanie2->setCzyNajnowsza(1);
        $manager->persist($sprawozdanie2);
        $manager->flush();     
        
        $sprawozdanie3 = new Sprawozdanie();
        $sprawozdanie3->setUmowa($umowa);
        $sprawozdanie3->setCreatorId($beneficjentKonto->getId());
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $sprawozdanie3->setDataRejestracji($value);
        $sprawozdanie3->setNumerUmowy($umowa->getNumer());
        $sprawozdanie3->setOkres('styczeń - czwerwiec');
        $sprawozdanie3->setOkresId(0);
        $sprawozdanie3->setRok(2018);
        $sprawozdanie3->setStatus(1);
        $sprawozdanie3->setWersja(1);
        $sprawozdanie3->setCzyNajnowsza(1);
        $manager->persist($sprawozdanie3);
        $manager->flush();     
        
        $sprawozdanie4 = new Sprawozdanie();
        $sprawozdanie4->setUmowa($umowa);
        $sprawozdanie4->setCreatorId($beneficjentKonto->getId());
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $sprawozdanie4->setDataRejestracji($value);
        $sprawozdanie4->setNumerUmowy($umowa->getNumer());
        $sprawozdanie4->setOkres('styczeń - czwerwiec');
        $sprawozdanie4->setOkresId(0);
        $sprawozdanie4->setRok(2019);
        $sprawozdanie4->setStatus(4);
        $sprawozdanie4->setWersja(1);
        $sprawozdanie4->setCzyNajnowsza(1);
        $manager->persist($sprawozdanie4);
        $manager->flush();
        
        
        $beneficjentFormaPrawnaNames = ['Spółka z o.o.',
            'Spółka akcyjna',
            'Spółka komandytowa / SKA',
            'Inna forma prawna',
            'Spółka w likwidacji / zlikwidowana'];

        foreach ($beneficjentFormaPrawnaNames as $beneficjentFormaPrawnaName) {
            $record = new BeneficjentFormaPrawna();
            $record->setNazwa($beneficjentFormaPrawnaName);
            $manager->persist($record);
        }

        $manager->flush();

        $gospodarkaDzialNames = ['ICT (Hardware)',
            'ICT (Software)',
            'ICT (Big Data)',
            'ICT (Smart Technologies)',
            'Medycyna',
            'Chemia',
            'Biotechnologia',
            'Energetyka',
            'Lotnictwo / Przemysł Kosmiczny',
            'Automotive',
            'Przemysł',
            'Ochrona środowiska',
            'Fintech',
            'Inne',
        ];

        foreach ($gospodarkaDzialNames as $gospodarkaDzialName) {
            $record = new GospodarkaDzial();
            $record->setNazwa($gospodarkaDzialName);
            $manager->persist($record);
        }

        $manager->flush();

        $wojewodztwa = ['DOLNOŚLĄSKIE',
            'KUJAWSKO-POMORSKIE',
            'LUBELSKIE',
            'LUBUSKIE',
            'ŁÓDZKIE',
            'MAŁOPOLSKIE',
            'MAZOWIECKIE',
            'OPOLSKIE',
            'PODKARPACKIE',
            'PODLASKIE',
            'POMORSKIE',
            'ŚLĄSKIE',
            'ŚWIĘTOKRZYSKIE',
            'WARMIŃSKO-MAZURSKIE',
            'WIELKOPOLSKIE',
            'ZACHODNIOPOMORSKIE'];
        $this->sortPl($wojewodztwa);

        foreach ($wojewodztwa as $wojewodztwo) {
            $record = new Wojewodztwo();
            $record->setNazwa($wojewodztwo);
            $manager->persist($record);
        }

        $manager->flush();
    }

    /**
     * Metoda sortująca tablicę elementów z
     * polskimi znakami 
     * 
     * @param  array $array
     * @return array
     */
    private function sortPl($array)
    {
        $arrayPol = array(
            'Ą', 'ą', 'Ć', 'ć', 'Ę', 'ę', 'Ł', 'ł', 'Ń', 'ń', 'Ó', 'ó', 'Ś', 'ś', 'Ź', 'ź', 'Ż', 'ż'
        );
        $arrayNew = array(
            'B!!', 'b!!', 'D!!', 'd!!', 'F!!', 'f!!', 'M!!', 'm!!', 'O!!', 'o!!', 'P!!', 'p!!', 'T!!', 't!!', 'ZZ!!', 'zz!!', 'ZZZ%!!', 'zzz%!!'
        );
        $text = implode('^^^', $array);
        $newtext = str_replace($arrayPol, $arrayNew, $text);
        $newArray = explode('^^^', $newtext);
        sort($newArray);
        $text2 = implode('^^^', $newArray);
        $newtext2 = str_replace($arrayNew, $arrayPol, $text2);
        $final = explode('^^^', $newtext2);
        
        return $final;
    }
}
