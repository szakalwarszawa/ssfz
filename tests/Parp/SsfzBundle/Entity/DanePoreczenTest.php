<?php

namespace Test\Parp\SsfzBundle\Entity;;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\DanePoreczen;

/**
 * Testy encji DanePoreczen.
 *
 * @covers \Parp\SsfzBundle\Entity\DanePoreczen
 *
 * Testy dotyczą anemicznej encji. Każde właściwość zachowuje się identycznie:
 * jest chroniona, ustawiana mutatorem i odczytywana akcesorem - bez żadnych modyfikacji.
 * Celem otestowania jest eliminacja potencjalnych literówek w dużej ilości kodu.
 * Brak logiki do testowania.
 * 
 * Uwaga!
 * Dane w formacie decimal (po stronie bazy danych) są przez Doctrine mapowane na typ PHP "string",
 * a nie na "float". Unika się w ten sposób utraty precyzji.
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/2.9/reference/types.html#decimal
 *
 * @todo Być może należy test uprścić jeszcze bardziej i dynamicznie (refleksją) odczytywać
 * dostępne metody (getX i setX). Nie będzie konieczna katualizacja wykazu pól po każdej
 * modyfikacji encji.
 *
 * php7.2 ./bin/phpunit --bootstrap ./vendor/autoload.php --config ./tests/phpunit.xml ./tests/Parp/SsfzBundle/Entity/DanePoreczenTest.php
 */
class DanePoreczenTest extends TestCase
{
    /**
     * @var string[]
     */
    const INTEGER_FIELDS = [
            'liczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw',
            'liczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw',
            'liczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPoreczenNaKredytObrotowyDo50000Pln',
            'liczbaPoreczenNaKredytObrotowyOd50001Do100000Pln',
            'liczbaPoreczenNaKredytObrotowyOd100001Do500000Pln',
            'liczbaPoreczenNaKredytObrotowyOd500001Pln',
            'liczbaPoreczenNaKredytInwestycyjnyDo50000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln',
            'liczbaPoreczenNaKredytInwestycyjnyOd500001Pln',
            'liczbaPoreczenNaPozyczkeObrotowaDo50000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln',
            'liczbaPoreczenNaPozyczkeObrotowaOd500001Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln',
            'liczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln',
            'liczbaPoreczenPozostalychDo50000Pln',
            'liczbaPoreczenPozostalychOd50001Do100000Pln',
            'liczbaPoreczenPozostalychOd100001Do500000Pln',
            'liczbaPoreczenPozostalychOd500001Pln',
            'liczbaWadiowPoreczenPozostalychDo50000Pln',
            'liczbaWadiowPoreczenPozostalychOd50001Do100000Pln',
            'liczbaWadiowPoreczenPozostalychOd100001Do500000Pln',
            'liczbaWadiowPoreczenPozostalychOd500001Pln',
            'liczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne',
            'liczbaPoreczenDo50000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe',
            'liczbaPoreczenOd500001PlnNaDzialaniaHandlowe',
            'liczbaPoreczenDo50000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe',
            'liczbaPoreczenOd500001PlnNaDzialaniaUslugowe',
            'liczbaPoreczenDo50000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze',
            'liczbaPoreczenOd500001PlnNaDzialaniaBudownicze',
            'liczbaPoreczenDo50000PlnNaDzialaniaInne',
            'liczbaPoreczenOd50001Do100000PlnNaDzialaniaInne',
            'liczbaPoreczenOd100001Do500000PlnNaDzialaniaInne',
            'liczbaPoreczenOd500001PlnNaDzialaniaInne',
            'liczbaPoreczenDo50000PlnDlaBankow',
            'liczbaPoreczenOd50001Do100000PlnDlaBankow',
            'liczbaPoreczenOd100001Do500000PlnDlaBankow',
            'liczbaPoreczenOd500001PlnDlaBankow',
            'liczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych',
            'liczbaPoreczenDo50000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow',
            'liczbaPoreczenOd500001PlnDlaInnychPodmiotow',
            'liczbaWspolpracujacychBankow',
            'liczbaWspolpracujacychFunduszyPozyczkowych',
            'liczbaInnychPodmiotowWspolpracujacych',
    ];

    const DECIMAL_FIELDS = [
        'kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw',
        'kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw',
        'kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPoreczenNaKredytObrotowyDo50000Pln',
        'kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln',
        'kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln',
        'kwotaPoreczenNaKredytObrotowyOd500001Pln',
        'kwotaPoreczenNaKredytInwestycyjnyDo50000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln',
        'kwotaPoreczenNaKredytInwestycyjnyOd500001Pln',
        'kwotaPoreczenNaPozyczkeObrotowaDo50000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln',
        'kwotaPoreczenNaPozyczkeObrotowaOd500001Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln',
        'kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln',
        'kwotaPoreczenPozostalychDo50000Pln',
        'kwotaPoreczenPozostalychOd50001Do100000Pln',
        'kwotaPoreczenPozostalychOd100001Do500000Pln',
        'kwotaPoreczenPozostalychOd500001Pln',
        'kwotaWadiowPoreczenPozostalychDo50000Pln',
        'kwotaWadiowPoreczenPozostalychOd50001Do100000Pln',
        'kwotaWadiowPoreczenPozostalychOd100001Do500000Pln',
        'kwotaWadiowPoreczenPozostalychOd500001Pln',
        'kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne',
        'kwotaPoreczenDo50000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe',
        'kwotaPoreczenOd500001PlnNaDzialaniaHandlowe',
        'kwotaPoreczenDo50000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe',
        'kwotaPoreczenOd500001PlnNaDzialaniaUslugowe',
        'kwotaPoreczenDo50000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze',
        'kwotaPoreczenOd500001PlnNaDzialaniaBudownicze',
        'kwotaPoreczenDo50000PlnNaDzialaniaInne',
        'kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne',
        'kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne',
        'kwotaPoreczenOd500001PlnNaDzialaniaInne',
        'kwotaPoreczenDo50000PlnDlaBankow',
        'kwotaPoreczenOd50001Do100000PlnDlaBankow',
        'kwotaPoreczenOd100001Do500000PlnDlaBankow',
        'kwotaPoreczenOd500001PlnDlaBankow',
        'kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych',
        'kwotaPoreczenDo50000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow',
        'kwotaPoreczenOd500001PlnDlaInnychPodmiotow',
    ];

    /**
     * @var DanePozyczek
     */
    protected $danePoreczen;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->danePoreczen = new DanePoreczen();
    }

    public function testCanBeInstantioned()
    {
        $this->assertInstanceOf(DanePozyczek::class, $this->danePoreczen);
    }

    public function testContainsValidInitialIntegers()
    {
        foreach (self::INTEGER_FIELDS as $field) {
            $getter = 'get'.ucfirst($field);
            $value = $this->danePoreczen->$getter();

            $this->assertSame(0, $value, "Failed asserting that $value is identical to 0 (property \"$field\").");
        }
    }

    public function testContainsValidInitialDecimals()
    {
        foreach (self::DECIMAL_FIELDS as $field) {
            $getter = 'get'.ucfirst($field);
            $value = $this->danePoreczen->$getter();

            $this->assertSame('0.00', $value, "Failed asserting that $value is identical to 0.00 (property \"$field\").");
        }
    }

    public function testCanSetAndGetIntegers()
    {
        $i = 0;
        foreach (self::INTEGER_FIELDS as $field) {
            $i++;
            $setter = 'set'.ucfirst($field);
            $getter = 'get'.ucfirst($field);
            $this->danePoreczen->$setter($i);
            $value = $this->danePoreczen->$getter();

            $this->assertSame($i, $value, "Failed asserting that $value is identical to $i (property \"$field\").");
        }
    }

    public function testCanSetAndGetDecimals()
    {
        $i = '0.00';
        foreach (self::DECIMAL_FIELDS as $field) {
            $i = (string)((float) $i + 0.01);
            $setter = 'set'.ucfirst($field);
            $getter = 'get'.ucfirst($field);
            $this->danePoreczen->$setter($i);
            $value = $this->danePoreczen->$getter();

            $this->assertSame($i, $value, "Failed asserting that $value is identical to $i (property \"$field\").");
        }
    }


    public function testCanSumByWielkoscPrzedsiebiorstwa()
    {
        $this
            ->danePoreczen
            ->setLiczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw(1)
            ->setLiczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw(2)
            ->setLiczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw(3)
            ->setLiczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw(3)
            ->setLiczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw(3)
            ->setLiczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw(3)
            ->setLiczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw(3)
            ->setLiczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw(3)
        ;

        $this
            ->danePoreczen
            ->setKwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw('1.01')
            ->setKwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw('2.02')
            ->setKwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw('3.03')
            ->setKwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw('3.03')
            ->setKwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw('3.03')
            ->setKwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw('3.03')
            ->setKwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw('3.03')
            ->setKwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw('3.03')
        ;
        
        $this->assertSame(6, $this->danePoreczen->getLiczbaPozyczekDlaMikroPrzedsiebiorstwOgolem());
        $this->assertSame(12, $this->danePoreczen->getLiczbaPozyczekDlaMalychPrzedsiebiorstwOgolem());
        $this->assertSame(18, $this->danePoreczen->getLiczbaPozyczekDlaSrednichPrzedsiebiorstwOgolem());
        $this->assertSame(36, $this->danePoreczen->getLiczbaPozyczekDlaPrzedsiebiorstwOgolem());

        $this->assertSame('6.06', $this->danePoreczen->getKwotaPozyczekDlaMikroPrzedsiebiorstwOgolem());
        $this->assertSame('12.12', $this->danePoreczen->getKwotaPozyczekDlaMalychPrzedsiebiorstwOgolem());
        $this->assertSame('18.18', $this->danePoreczen->getKwotaPozyczekDlaSrednichPrzedsiebiorstwOgolem());
        $this->assertSame('36.36', $this->danePoreczen->getKwotaPozyczekDlaPrzedsiebiorstwOgolem());
    }

    public function testCanSumByPrzeznaczenie()
    {
        $this
            ->danePoreczen
            ->setLiczbaPozyczekObrotowychDo10000Pln(1)
            ->setLiczbaPozyczekObrotowychOd10001Do30000Pln(1)
            ->setLiczbaPozyczekObrotowychOd30001Do50000Pln(1)
            ->setLiczbaPozyczekObrotowychOd50001Do120000Pln(1)
            ->setLiczbaPozyczekObrotowychOd120001Do300000Pln(1)
            ->setLiczbaPozyczekObrotowychOd300001Pln(1)
            ->setLiczbaPozyczekInwestycyjnychDo10000Pln(2)
            ->setLiczbaPozyczekInwestycyjnychOd10001Do30000Pln(2)
            ->setLiczbaPozyczekInwestycyjnychOd30001Do50000Pln(2)
            ->setLiczbaPozyczekInwestycyjnychOd50001Do120000Pln(2)
            ->setLiczbaPozyczekInwestycyjnychOd120001Do300000Pln(2)
            ->setLiczbaPozyczekInwestycyjnychOd300001Pln(2)
            ->setLiczbaPozyczekInwestycyjnoObrotowychDo10000Pln(3)
            ->setLiczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln(3)
            ->setLiczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln(3)
            ->setLiczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln(3)
            ->setLiczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln(3)
            ->setLiczbaPozyczekInwestycyjnoObrotowychOd300001Pln(3)
        ;

        $this
            ->danePoreczen
            ->setKwotaPozyczekObrotowychDo10000Pln('1.01')
            ->setKwotaPozyczekObrotowychOd10001Do30000Pln('1.01')
            ->setKwotaPozyczekObrotowychOd30001Do50000Pln('1.01')
            ->setKwotaPozyczekObrotowychOd50001Do120000Pln('1.01')
            ->setKwotaPozyczekObrotowychOd120001Do300000Pln('1.01')
            ->setKwotaPozyczekObrotowychOd300001Pln('1.01')
            ->setKwotaPozyczekInwestycyjnychDo10000Pln('2.02')
            ->setKwotaPozyczekInwestycyjnychOd10001Do30000Pln('2.02')
            ->setKwotaPozyczekInwestycyjnychOd30001Do50000Pln('2.02')
            ->setKwotaPozyczekInwestycyjnychOd50001Do120000Pln('2.02')
            ->setKwotaPozyczekInwestycyjnychOd120001Do300000Pln('2.02')
            ->setKwotaPozyczekInwestycyjnychOd300001Pln('2.02')
            ->setKwotaPozyczekInwestycyjnoObrotowychDo10000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd300001Pln('3.03')
        ;
        
        $this->assertSame(6, $this->danePoreczen->getLiczbaPozyczekObrotowychOgolem());
        $this->assertSame(12, $this->danePoreczen->getLiczbaPozyczekInwestycyjnychOgolem());
        $this->assertSame(18, $this->danePoreczen->getLiczbaPozyczekInwestycyjnoObrotowychOgolem());
        $this->assertSame(36, $this->danePoreczen->getLiczbaPozyczekDlaWszystkichPrzeznaczenOgolem());

        $this->assertSame('6.06', $this->danePoreczen->getKwotaPozyczekObrotowychOgolem());
        $this->assertSame('12.12', $this->danePoreczen->getKwotaPozyczekInwestycyjnychOgolem());
        $this->assertSame('18.18', $this->danePoreczen->getKwotaPozyczekInwestycyjnoObrotowychOgolem());
        $this->assertSame('36.36', $this->danePoreczen->getKwotaPozyczekDlaWszystkichPrzeznaczenOgolem());
    }

    public function testCanSumBySektorDzialalnosci()
    {
        $this
            ->danePoreczen
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne(1)
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaHandlowe(2)
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaUslugowe(3)
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaBudownicze(4)
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaRolnicze(5)
            ->setLiczbaPozyczekDo10000PlnNaDzialaniaInne(6)
            ->setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaInne(6)
            ->setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaInne(6)
            ->setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaInne(6)
            ->setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaInne(6)
            ->setLiczbaPozyczekOd300001PlnNaDzialaniaInne(6)
        ;

        $this
            ->danePoreczen
            ->setKwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne('1.01')
            ->setKwotaPozyczekDo10000PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaHandlowe('2.02')
            ->setKwotaPozyczekDo10000PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaUslugowe('3.03')
            ->setKwotaPozyczekDo10000PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaBudownicze('4.04')
            ->setKwotaPozyczekDo10000PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaRolnicze('5.05')
            ->setKwotaPozyczekDo10000PlnNaDzialaniaInne('6.06')
            ->setKwotaPozyczekOd10001Do30000PlnNaDzialaniaInne('6.06')
            ->setKwotaPozyczekOd30001Do50000PlnNaDzialaniaInne('6.06')
            ->setKwotaPozyczekOd50001Do120000PlnNaDzialaniaInne('6.06')
            ->setKwotaPozyczekOd120001Do300000PlnNaDzialaniaInne('6.06')
            ->setKwotaPozyczekOd300001PlnNaDzialaniaInne('6.06')
        ;

        $this->assertSame(6, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaProdykcyjneOgolem());
        $this->assertSame(12, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaHandloweOgolem());
        $this->assertSame(18, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaUslugoweOgolem());
        $this->assertSame(24, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaBudowniczeOgolem());
        $this->assertSame(30, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaRolniczeOgolem());
        $this->assertSame(36, $this->danePoreczen->getLiczbaPozyczekNaDzialaniaInneOgolem());
        $this->assertSame(126, $this->danePoreczen->getLiczbaPozyczekOgolemDlaWszystkichSektorowDzialan());

        $this->assertSame('6.06', $this->danePoreczen->getKwotaPozyczekNaDzialaniaProdykcyjneOgolem());
        $this->assertSame('12.12', $this->danePoreczen->getKwotaPozyczekNaDzialaniaHandloweOgolem());
        $this->assertSame('18.18', $this->danePoreczen->getKwotaPozyczekNaDzialaniaUslugoweOgolem());
        $this->assertSame('24.24', $this->danePoreczen->getKwotaPozyczekNaDzialaniaBudowniczeOgolem());
        $this->assertSame('30.30', $this->danePoreczen->getKwotaPozyczekNaDzialaniaRolniczeOgolem());
        $this->assertSame('36.36', $this->danePoreczen->getKwotaPozyczekNaDzialaniaInneOgolem());
        $this->assertSame('127.26', $this->danePoreczen->getKwotaPozyczekOgolemDlaWszystkichSektorowDzialan());
    }
}
