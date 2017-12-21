<?php
namespace Parp\SsfzBundle\Tests\Form\Type;

use Parp\SsfzBundle\Form\Type\ChangePasswordType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Testuje klasę ChangePasswordType
 * 
 * @covers \Parp\SsfzBundle\Form\Type\ChangePasswordType
 */
class ChangePasswordTypeTest extends TypeTestCase
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
            'oldPassword' => 'stare_haslo',
            'newPassword' => array('first' => 'n0vv3h@sl0123', 'second' => 'n0vv3h@sl0123')
        );

        $form = $this->factory->create(ChangePasswordType::class);

        $object = new \Parp\SsfzBundle\Form\Model\ChangePassword;
        $object->setOldPassword('stare_haslo');
        $object->setNewPassword('n0vv3h@sl0123');

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
