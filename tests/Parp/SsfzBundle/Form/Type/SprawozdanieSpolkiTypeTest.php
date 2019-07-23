<?php

namespace Test\Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of SprawozdanieSpolkiTypeTest
 *
 * @author adamw
 */
class SprawozdanieSpolkiTypeTest
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
        $sprawozdanie = new \Parp\SsfzBundle\Entity\Sprawozdanie();

        $formData = array(
            '$id' => 1,
            '$sprawozdanieId' => 2,
            '$lp' => $dateNow,
            '$nazwaSpolki' => 3,
            '$krs' => '12345',
            '$uzyskanePrzychody' => 4,
            '$planowanePrzychody' => 5,
            '$ebitda' => 6,
            '$ncf' => 7,
            '$sumaBilansowa' => 8,
            '$zatrudnienieEtaty' => 23,
            '$zatrudnioneKobiety' => 10,
            '$zatrudnieniMezczyzni' => 13,
            '$zatrudnienieInneFormy' => 12,
            '$zatrudnienieInneFormyKobiety' => 8,
            '$zatrudnienieInneFormyMezczyzni' => 4,
            '$zatrudnieniewStosunkuDoPoprzedniegoRoku' => 1,
            '$zatrudnieniewStosunkuDoPoprzedniegoOkresu' => 2,
            'sprawozdanie' =>$sprawozdanie,
        );


        $form = $this->factory->create(\Parp\SsfzBundle\Form\Type\SprawozdanieSpolkiType::class);
        $object = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();

        $object->setId(1);
        $object->setSprawozdanie($sprawozdanie);
        $object->setLp($dateNow);
        $object->setNazwaSpolki(3);
        $object->setKrs('12345');
        $object->setUzyskanePrzychody(4);
        $object->setPlanowanePrzychody(50);
        $object->setNcf(6);
        $object->setSumaBilansowa(7);
        $object->setZatrudnienieEtaty(23);
        $object->setZatrudnioneKobiety(10);
        $object->setZatrudnieniMezczyzni(13);
        $object->setZatrudnienieInneFormy(12);
        $object->setZatrudnienieInneFormyKobiety(8);
        $object->setZatrudnienieInneFormyMezczyzni(4);
        $object->setZatrudnieniewStosunkuDoPoprzedniegoRoku(1);
        $object->setZatrudnieniewStosunkuDoPoprzedniegoOkresu(2);
        $object->setSprawozdanie($sprawozdanie);

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
