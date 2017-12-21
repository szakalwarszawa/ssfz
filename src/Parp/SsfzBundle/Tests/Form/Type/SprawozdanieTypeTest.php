<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
/**
 * Description of SprawozdanieTypeTest
 *
 * @author adamw
 */
class SprawozdanieTypeTest extends TypeTestCase
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
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $umowa->setNumer('1/2017');
        $sprawozdanieSpolek = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
        $lista =  array($sprawozdanieSpolek);
        /*$formData = array(
            'id' => 5,
            'creatorId' => 2,
            'dataRejestracji' => $dateNow,
            'umowaId' => 3,
            'previousVersionId' => 4,
            'umowa' => $umowa,
            'numerUmowy' => '1/2017',
            'okres' => 'styczeń - czerwiec',
            'okresId' => 0,
            'rok' => '2016',
            'status' => 1,
            'wersja' => 1,
            'czyNajnowsza' => true,
            'dataPrzeslaniaDoParp' => $dateNow,
            'oceniajacyId' => 12,
            'dataZatwierdzenia' => $dateNow,
            'uwagi' => 'Brak uwag',
            'sprawozdaniaSpolek' => $lista,
            'idStatus' => 1,
        );*/ 
        
        $formData = array(
            'numerUmowy' => '1/2017',
            'okres' => 'styczeń - czerwiec',
            'rok' => 2016,
            'uwagi' => 'uwagi',
        );
        $form = $this->factory->create(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class);
        $object = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        
        /*$object->setId(7);
        $object->setCreatorId(2);
        $object->setDataRejestracji($dateNow);
        $object->setUmowaId(3);
        $object->setPreviousVersionId(4);
        $object->setUmowa($umowa);
        $object->setNumerUmowy('1/2017');
        $object->setOkres('styczeń - czerwiec');
        $object->setOkresId(0);
        $object->setRok('2016');
        $object->setStatus(1);
        $object->setWersja(1);
        $object->setCzyNajnowsza(true);
        $object->setDataPrzeslaniaDoParp($dateNow);
        $object->setOceniajacyId(12);
        $object->setDataZatwierdzenia($dateNow);
        $object->setUwagi('Brak uwag');
        $object->setSprawozdaniaSpolek($lista);
        $object->setIdStatus(1);*/
        
        $object->setNumerUmowy('1/2017');
        $object->setOkres('styczeń - czerwiec');
        $object->setRok(2016);
        $object->setUwagi('uwagi');
        
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
