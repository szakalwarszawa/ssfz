<?php

namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\Beneficjent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Email;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Typ formularza sprawozdania spolki
 */
class SprawozdanieSpolkiType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania sprawozdania spolki
     * 
     * @SuppressWarnings("unused")
     * 
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  
        $builder->add('liczbaPorzadkowa', null, array(
            'label' => 'Lp.',   
            'attr' => array('readonly' => true)         
        ));
        $builder->add('nazwaSpolki', null, array(
            'label' => 'Nazwa spółki',   
            'attr' => array('readonly' => true),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        ));
        $builder->add('krs', TextType::class, array(
            'label' => 'Nr KRS',   
            'attr' => array('readonly' => true),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        ));
        $builder->add('uzyskanePrzychody', TextType::class, array(
            'label' => 'Uzyskane przychody w okresie sprawozdawczym', 
            'attr' => array('class' => 'decimal'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(                
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/')                
                )
            ),       
        ));
        $builder->add('planowanePrzychody', TextType::class, array(
            'label' => 'Planowane przychody w nast. okresie w stosunku do aktualnego (%)',   
            'attr' => array('class' => 'decimal'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(                
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/')                
                )
            )          
        ));
        $builder->add('ebitda', TextType::class, array(
            'label' => 'EBITDA',   
            'attr' => array('class' => 'decimal'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(                
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/')                
                )
            )         
        ));
        $builder->add('ncf', TextType::class, array(
            'label' => 'NCF',   
            'attr' => array('class' => 'decimal'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(                
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/')                
                )
            )          
        ));
        $builder->add('sumaBilansowa', TextType::class, array(
            'label' => 'Suma bilansowa',
            'attr' => array('class' => 'decimal'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(                
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/')                
                )
            )          
        ));
        $builder->add('zatrudnienieEtaty', null, array(
            'label' => 'Zatrudnienie (Etaty)', 
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnioneKobiety', null, array(
            'label' => 'W tym kobiety',
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnieniMezczyzni', null, array(
            'label' => 'W tym mężczyźni', 
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnienieInneFormy', null, array(
            'label' => 'Zatrudnienie (Inne formy)', 
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnienieInneFormyKobiety', null, array(
            'label' => 'W tym kobiety', 
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnienieInneFormyMezczyzni', null, array(
            'label' => 'W tym mężczyźni',
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnieniewStosunkuDoPoprzedniegoRoku', null, array(
            'label' => 'Zmiana zatrudnienia w stosunku do poprzedniego okresu (Etaty)', 
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
        $builder->add('zatrudnieniewStosunkuDoPoprzedniegoOkresu', null, array(
            'label' => 'Zmiana zatrudnienia w stosunku do poprzedniego okresu (Inne formy)',
            'attr' => array('class' => 'integer'),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )          
        )); 
    }
    
    
    /**
     * Ustawia opcje konfiguracji
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \Parp\SsfzBundle\Entity\SprawozdanieSpolki::class,
            'attr' => array('novalidate' => 'novalidate'),
            'showRemarks' => null,
        ));
    }
}


