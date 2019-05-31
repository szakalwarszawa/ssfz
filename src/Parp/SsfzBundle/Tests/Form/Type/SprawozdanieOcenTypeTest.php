<?php

namespace Parp\SsfzBundle\Tests\Form\Type;

use Parp\SsfzBundle\Form\Type\SprawozdanieOcenType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Testuje klasę SprawozdanieOcenType
 *
 * @covers \Parp\SsfzBundle\Form\Type\SprawozdanieOcenType
 */
class SprawozdanieOcenTypeTest extends TypeTestCase
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
        $formData = array(
            'uwagi' => 'Test',
            'status' => '4'
        );

        $form = $this->factory->create(SprawozdanieOcenType::class);
        $object = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $object->setUwagi('Test');
        $object->setStatus('4');
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
