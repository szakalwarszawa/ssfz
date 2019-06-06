<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikOgolem;
use Parp\SsfzBundle\Entity\Slowniki\Skladnik;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePozyczkoweSkladnikOgolemType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'skladnik',
            EntityType::class,
            array(
                'label'     => 'Składniki',
                'class'     => Skladnik::class,
                'required'  => false,
                'choice_label'  => 'nazwa',
                'expanded' => false,
                'placeholder' => '',
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    )
                )
            )
        );

        $builder->add(
            'wartosc',
            MoneyType::class,
            [
                'label'  => 'Wartość składników (zł)',
                'required'  => false,
                'currency'  => 'PLN',
                'mapped' => true,
                'attr'   => [
                    'placeholder' => 'kwota w PLN',
                    'class'       => 'width-short',
                    'maxlength' => 12,
                ],
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                )
            ]
        );
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => SprawozdaniePozyczkoweSkladnikOgolem::class,
        ));
    }
}
