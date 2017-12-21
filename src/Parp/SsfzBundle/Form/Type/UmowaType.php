<?php

namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\Umowa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Typ formularza Umowa - podformularz profilu beneficjenta
 */
class UmowaType extends AbstractType
{
    /**
     * Buduje formularz do wypełnienia danych umowy
     * 
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'numer', null, array(
            'label' => 'Numer umowy',   
            'constraints' => array(
                new NotBlank(array('message' => 'Należy wypełnić pole'))                
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
            'data_class' => Umowa::class
            )
        );
    }
}

