<?php

namespace Parp\SsfzBundle\Tests\Form\Type;

use Parp\SsfzBundle\Form\Type\OsobaZatrudnionaType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

/**
 * Testuje klasę OsobaZatrudnionaType
 *
 * @covers \Parp\SsfzBundle\Form\Type\OsobaZatrudnionaType
 */
class OsobaZatrudnionaTypeTest extends TypeTestCase
{
    /**
     * Dodaje rozszerzenia formularzy
     *
     * @return collection
     */
    protected function getExtensions()
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this
            ->validator
            ->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()))
        ;
        $this
            ->validator
            ->method('getMetadataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)))
        ;

        return array(
            new ValidatorExtension($this->validator),
        );
    }

    /**
     * Testuje submit formularza
     */
    public function testSubmitValidData()
    {
        $formData = array(
            'imie' => 'Imię',
            'nazwisko' => 'Nazwisko',
            'umowaRodzaj' => 'na czas nieokreślony',
            'stanowisko' =>'stanowisko',
            'wymiar' =>'1/1',
        );

        $form = $this->factory->create(OsobaZatrudnionaType::class);
        $object = new \Parp\SsfzBundle\Entity\OsobaZatrudniona();
        $object->setImie('Imię');
        $object->setNazwisko('Nazwisko');
        $object->setUmowaRodzaj('na czas nieokreślony');
        $object->setStanowisko('stanowisko');
        $object->setWymiar('1/1');

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
