<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use \Parp\SsfzBundle\Entity;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
/**
 * Description of PrzeplywTypeTest
 *
 * @author adamw
 */
class PrzeplywFinansowyTypeTest extends TypeTestCase
{
    
    /**
     * Dodaje rozszerzenia formularzy
     * 
     * @return collection
     */
    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator
            ->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator
            ->method('getMetadataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)));

        return array(
            new ValidatorExtension($this->validator),
        );
    }

    /**
     * Testuje submit formularza
     */
    public function testSubmitValidData()
    {
        $dateNow = new \DateTime('now');
        
        /*$formData = array(
            'id' => 1,
            'creatorId' => 2,
            'dataRejestracji' => $dateNow,
            'sprawozdanieId' => 3,
            'saldoPoczatkowe' => 0.00,
            'wplywy' => 100.60,
            'wyjsciaZInwestycji' => 20.10,
            'udzialWZyskach' => 20.20,
            'inneWplywy' => 60.30,
            'wyplywy' => 151.50,
            'wejsciaKapitalowe' => 10.10,
            'preinkubacjaPomyslow' => 20.20,
            'wydatkiOperacyjne' => 30.30,
            'podatki' => 40.40,
            'inneWyplywy' => 50.50,
            'saldoKoncowe' => -50.90,
            'liczbaPomyslowWInkubatorze' => 1,
            'liczbaPomyslowOcenionych' => 2,
            'liczbaPomyslowOcenionychPozytywnie' => 3,
            'liczbaPomyslowOcenionychNegatywnie' => 4,
            'liczbaZakonczonychPreinkubacji' => 5,
            'liczbaDokonanychInwestycji' => 6,
        );*/

        $formData = array(
            'saldoPoczatkowe' => '0.00',
            'wplywy' => 100.60,
            'wyjsciaZInwestycji' => 20.10,
            'udzialWZyskach' => 20.20,
            'inneWplywy' => 60.30,
            'wyplywy' => 151.50,
            'wejsciaKapitalowe' => 10.10,
            'preinkubacjaPomyslow' => 20.20,
            'wydatkiOperacyjne' => 30.30,
            'podatki' => 40.40,
            'inneWyplywy' => 50.50,
            'saldoKoncowe' => -50.90,
            'liczbaPomyslowWInkubatorze' => 1,
            'liczbaPomyslowOcenionych' => 2,
            'liczbaPomyslowOcenionychPozytywnie' => 3,
            'liczbaPomyslowOcenionychNegatywnie' => 4,
            'liczbaZakonczonychPreinkubacji' => 5,
            'liczbaDokonanychInwestycji' => 6,
        );
        
        $form = $this->factory->create(\Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType::class);
        $object = new \Parp\SsfzBundle\Entity\PrzeplywFinansowy();
        

        $object->setSaldoPoczatkowe('0.00');
        $object->setWplywy('100.60');
        $object->setWyjsciaZInwestycji('20.10');
        $object->setUdzialWZyskach('20.20');
        $object->setInneWplywy('60.30');
        $object->setWyplywy('151.50');
        $object->setWejsciaKapitalowe('10.10');
        $object->setPreinkubacjaPomyslow('20.20');
        $object->setWydatkiOperacyjne('30.30');
        $object->setPodatki('40.40');
        $object->setInneWyplywy('50.50');
        $object->setSaldoKoncowe('-50.90');
        $object->setLiczbaPomyslowWInkubatorze('1');
        $object->setLiczbaPomyslowOcenionych('2');
        $object->setLiczbaPomyslowOcenionychPozytywnie('3');
        $object->setLiczbaPomyslowOcenionychNegatywnie('4');
        $object->setLiczbaZakonczonychPreinkubacji('5');
        $object->setLiczbaDokonanychInwestycji('6');
        

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
