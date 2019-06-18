<?php

namespace Test\Parp\SsfzBundle\Entity;;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\DanePozyczki;

/**
 * Testy encji DanePozyczki.
 *
 * @covers \Parp\SsfzBundle\Entity\DanePozyczki
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
 * php7.2 ./bin/phpunit --bootstrap ./vendor/autoload.php --config ./tests/phpunit.xml ./tests/Parp/SsfzBundle/Entity/DanePozyczkiTest.php 
 */
class DanePozyczkiTest extends TestCase
{
    /**
     * @var string[]
     */
    const INTEGER_FIELDS = [
        'liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw',
        'liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw',
        'liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw',
        'liczbaPozyczekObrotowychDo10000Pln',
        'liczbaPozyczekObrotowychOd10001Do30000Pln',
        'liczbaPozyczekObrotowychOd30001Do50000Pln',
        'liczbaPozyczekObrotowychOd50001Do120000Pln',
        'liczbaPozyczekObrotowychOd120001Do300000Pln',
        'liczbaPozyczekObrotowychOd300001Pln',
        'liczbaPozyczekInwestycyjnychDo10000Pln',
        'liczbaPozyczekInwestycyjnychOd10001Do30000Pln',
        'liczbaPozyczekInwestycyjnychOd30001Do50000Pln',
        'liczbaPozyczekInwestycyjnychOd50001Do120000Pln',
        'liczbaPozyczekInwestycyjnychOd120001Do300000Pln',
        'liczbaPozyczekInwestycyjnychOd300001Pln',
        'liczbaPozyczekInwestycyjnoObrotowychDo10000Pln',
        'liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln',
        'liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln',
        'liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln',
        'liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln',
        'liczbaPozyczekInwestycyjnoObrotowychOd300001Pln',
        'liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne',
        'liczbaPozyczekDo10000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe',
        'liczbaPozyczekOd300001PlnNaDzialaniaHandlowe',
        'liczbaPozyczekDo10000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe',
        'liczbaPozyczekOd300001PlnNaDzialaniaUslugowe',
        'liczbaPozyczekDo10000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze',
        'liczbaPozyczekOd300001PlnNaDzialaniaBudownicze',
        'liczbaPozyczekDo10000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze',
        'liczbaPozyczekOd300001PlnNaDzialaniaRolnicze',
        'liczbaPozyczekDo10000PlnNaDzialaniaInne',
        'liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne',
        'liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne',
        'liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne',
        'liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne',
        'liczbaPozyczekOd300001PlnNaDzialaniaInne',
    ];

    const DECIMAL_FIELDS = [
        'kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekObrotowychDo10000Pln',
        'kwotaPozyczekObrotowychOd10001Do30000Pln',
        'kwotaPozyczekObrotowychOd30001Do50000Pln',
        'kwotaPozyczekObrotowychOd50001Do120000Pln',
        'kwotaPozyczekObrotowychOd120001Do300000Pln',
        'kwotaPozyczekObrotowychOd300001Pln',
        'kwotaPozyczekInwestycyjnychDo10000Pln',
        'kwotaPozyczekInwestycyjnychOd10001Do30000Pln',
        'kwotaPozyczekInwestycyjnychOd30001Do50000Pln',
        'kwotaPozyczekInwestycyjnychOd50001Do120000Pln',
        'kwotaPozyczekInwestycyjnychOd120001Do300000Pln',
        'kwotaPozyczekInwestycyjnychOd300001Pln',
        'kwotaPozyczekInwestycyjnoObrotowychDo10000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd300001Pln',
        'kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekDo10000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd300001PlnNaDzialaniaHandlowe',
        'kwotaPozyczekDo10000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd300001PlnNaDzialaniaUslugowe',
        'kwotaPozyczekDo10000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd300001PlnNaDzialaniaBudownicze',
        'kwotaPozyczekDo10000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd300001PlnNaDzialaniaRolnicze',
        'kwotaPozyczekDo10000PlnNaDzialaniaInne',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne',
        'kwotaPozyczekOd300001PlnNaDzialaniaInne',
    ];

    /**
     * @var DanePozyczki
     */
    protected $danePozyczki;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->danePozyczki = new DanePozyczki();
    }

    public function testCanBeInstantioned()
    {
        $this->assertInstanceOf(DanePozyczki::class, $this->danePozyczki);
    }

    public function testContainsValidInitialIntegers()
    {
        foreach (self::INTEGER_FIELDS as $field) {
            $getter = 'get'.ucfirst($field);
            $value = $this->danePozyczki->$getter();

            $this->assertSame(0, $value);
        }
    }

    public function testContainsValidInitialDecimals()
    {
        foreach (self::DECIMAL_FIELDS as $field) {
            $getter = 'get'.ucfirst($field);
            $value = $this->danePozyczki->$getter();

            $this->assertSame('0.00', $value);
        }
    }

    public function testCanSetAndGetIntegers()
    {
        $i = 0;
        foreach (self::INTEGER_FIELDS as $field) {
            $i++;
            $setter = 'set'.ucfirst($field);
            $getter = 'get'.ucfirst($field);
            $this->danePozyczki->$setter($i);
            $value = $this->danePozyczki->$getter();

            $this->assertSame($i, $value);
        }
    }

    public function testCanSetAndGetDecimals()
    {
        $i = '0.00';
        foreach (self::DECIMAL_FIELDS as $field) {
            $i = (string)((float) $i + 0.01);
            $setter = 'set'.ucfirst($field);
            $getter = 'get'.ucfirst($field);
            $this->danePozyczki->$setter($i);
            $value = $this->danePozyczki->$getter();

            $this->assertSame($i, $value);
        }
    }


    public function testCanSumByWielkoscPrzedsiebiorstwa()
    {
        $this
            ->danePozyczki
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
            ->danePozyczki
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
        
        $this->assertSame(6, $this->danePozyczki->getLiczbaPozyczekOgolemDlaMikroPrzedsiebiorstw());
        $this->assertSame(12, $this->danePozyczki->getLiczbaPozyczekOgolemDlaMalychPrzedsiebiorstw());
        $this->assertSame(18, $this->danePozyczki->getLiczbaPozyczekOgolemDlaSrednichPrzedsiebiorstw());
        $this->assertSame(36, $this->danePozyczki->getLiczbaPozyczekOgolemDlaPrzedsiebiorstw());

        $this->assertSame('6.06', $this->danePozyczki->getKwotaPozyczekOgolemDlaMikroPrzedsiebiorstw());
        $this->assertSame('12.12', $this->danePozyczki->getKwotaPozyczekOgolemDlaMalychPrzedsiebiorstw());
        $this->assertSame('18.18', $this->danePozyczki->getKwotaPozyczekOgolemDlaSrednichPrzedsiebiorstw());
        $this->assertSame('36.36', $this->danePozyczki->getKwotaPozyczekOgolemDlaPrzedsiebiorstw());
    }






    public function testCanSumBySektorDzialalnosci()
    {
        $this
            ->danePozyczki
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
            ->danePozyczki
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
            ->setKwotaPozyczekInwestycyjnoObrotowychDo10000Pln(3)
            ->setKwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln('3.03')
            ->setKwotaPozyczekInwestycyjnoObrotowychOd300001Pln('3.03')
        ;
        
        $this->assertSame(6, $this->danePozyczki->getLiczbaPozyczekObrotowychOgolem);
        $this->assertSame(12, $this->danePozyczki->getLiczbaPozyczekInwestycyjnychOgolem());
        $this->assertSame(18, $this->danePozyczki->getLiczbaPozyczekInwestycyjnoObrotowychOgolem());
        $this->assertSame(36, $this->danePozyczki->getLiczbaPozyczekOgolemDlaWszystkichSektorowDzialan());

        $this->assertSame('6.06', $this->danePozyczki->getKwotaPozyczekObrotowychOgolem());
        $this->assertSame('12.12', $this->danePozyczki->getKwotaPozyczekInwestycyjnychOgolem());
        $this->assertSame('18.18', $this->danePozyczki->getKwotaPozyczekInwestycyjnoObrotowychOgolem());
        $this->assertSame('36.36', $this->danePozyczki->getKwotaPozyczekOgolemDlaWszystkichSektorowDzialan());
    }
}
