<?php

namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\OsobaZatrudniona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Typ formularza OsobaZatrudniona - podformularz profilu beneficjenta
 */ 
class OsobaZatrudnionaType extends AbstractType
{
    /**
     * Buduje formularz do wypełnienia danych osoby zatrudnionej
     * 
     * @param FormBuilderInterface $builder
     * @param array                $options
     * 
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'imie', null, array(
            'label' => 'Imię',   
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
            )
        );
        $builder->add(
            'nazwisko', null, array(
            'label' => 'Nazwisko',   
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
            )
        );
        $builder->add(
            'umowaRodzaj', ChoiceType::class, array(
            'choices' => array(
                '' => '',
                'na czas nieokreślony' => 'na czas nieokreślony',
                'na czas określony' => 'na czas określony',
                'na czas wykonywania określonej pracy' => 'na czas wykonywania określonej pracy',
                'na okres próbny' => 'na okres próbny',                
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )                      
            )
        );
        $builder->add(
            'umowaData', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => array(
                'class' => 'js-datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd'
            ),
            'label' => 'Data zawarcia umowy',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )                      
            )
        );
        $builder->add(
            'rozpoczecieData', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => array(
                'class' => 'js-datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd'
            ),
            'label' => 'Data rozpoczęcia pracy',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )                      
            )
        );
        $builder->add(
            'stanowisko', null, array(
            'label' => 'Stanowisko',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )                      
            )
        );
        $builder->add(
            'wymiar', null, array(
            'label' => 'Wymiar etatu',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )                      
            )
        );        
    }
    /**
     * Ustawia opcje konfiguracji
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) 
    {
        $resolver->setDefaults(
            array(
            'data_class' => OsobaZatrudniona::class,
            )
        );
    }       
}
