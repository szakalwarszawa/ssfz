<?php

namespace Parp\SsfzBundle\Tests\Form\Type;

use Parp\SsfzBundle\Form\Type\UzytkownikType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Testuje klasę UzytkownikType
 *
 * @covers \Parp\SsfzBundle\Form\Type\UzytkownikType
 */
class UzytkownikTypeTest extends TypeTestCase
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
            'login' => 'admin',
            'email' => 'admin@example.com',
            'haslo' => array('first' => 'n0vv3h@sl0123', 'second' => 'n0vv3h@sl0123')
        );

        $form = $this->factory->create(UzytkownikType::class);

        $object = new \Parp\SsfzBundle\Entity\Uzytkownik();
        $object->setLogin('admin');
        $object->setHaslo('n0vv3h@sl0123');
        $object->setEmail('admin@example.com');

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
