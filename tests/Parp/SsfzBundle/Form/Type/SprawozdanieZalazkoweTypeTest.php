<?php

namespace Test\Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Form\Type\SprawozdanieZalazkoweType;

/**
 * Description of SprawozdanieZalazkoweTypeTest
 */
class SprawozdanieZalazkoweTypeTest extends TypeTestCase
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

        return [
            new ValidatorExtension($this->validator),
        ];
    }

    /**
     * Testuje submit formularza
     */
    public function testSubmitValidData()
    {
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $umowa->setNumer('1/2017');

        $formData = [
            'numerUmowy' => '1/2017',
            'okres'      => 'styczeń - czerwiec',
            'rok'        => 2016,
            'uwagi'      => 'uwagi',
        ];
        $form = $this->factory->create(SprawozdanieZalazkoweType::class, null, [
            'lata' => [
                '2016' => '2016',
                '2017' => '2017',
                '2018' => '2018',
                '2019' => '2019',
            ],
        ]);
        $object = new SprawozdanieZalazkowe();

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
