<?php

namespace Parp\SsfzBundle\Tests\Form\Type;

use Parp\SsfzBundle\Form\Type\BeneficjentType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Testuje klasę BemeficjentType
 * 
 * @covers \Parp\SsfzBundle\Form\Type\BeneficjentType
 */
class BeneficjentTypeTest extends TypeTestCase
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
            'nazwa' => 'NazwaTest',
            'adrWojewodztwo' => 'podlaskie',
            'adrMiejscowosc' => 'MiejscowoscTest',
            'adrUlica' => 'UlicaTest',
            'adrBudynek' =>'1', 
            'adrLokal' =>'1',
            'adrKod' =>'11-111',
            'adrPoczta' =>'PocztaTest',
            'telStacjonarny' =>'123456789',
            'telKomorkowy' =>'123456789',
            'email' =>'test@test.pl',
            'fax' =>'123456789',   
            'umowy' => new CollectionType(),
            'osobyZatrudnione' => new CollectionType(),
        );

        $form = $this->factory->create(BeneficjentType::class);
        $object = new \Parp\SsfzBundle\Entity\Beneficjent();
        $object->setNazwa('NazwaTest');
        $object->setAdrWojewodztwo('podlaskie');
        $object->setAdrMiejscowosc('MiejscowoscTest');
        $object->setAdrUlica('UlicaTest');
        $object->setAdrBudynek('1'); 
        $object->setAdrLokal('1');
        $object->setAdrKod('11-111');
        $object->setAdrPoczta('PocztaTest');
        $object->setTelStacjonarny('123456789');
        $object->setTelKomorkowy('123456789');
        $object->setEmail('test@test.pl');
        $object->setFax('123456789');
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
