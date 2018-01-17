<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Typ formularza oceny sprawozdania
 */
class SprawozdanieOcenType extends AbstractType
{
    /**
     * Buduje formularz do dodania komentarza przy cofnięciu sprawozdania
     * do beneficjenta
     * 
     * @param FormBuilderInterface $builder
     * @param array                $options
     * 
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'uwagi', HiddenType::class, array(            
            )
        );
        $builder->add(
            'status', HiddenType::class, array(                         
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
            'data_class' => \Parp\SsfzBundle\Entity\Sprawozdanie::class,
            'attr' => array('novalidate' => 'novalidate'),
            )
        );
    }
}


