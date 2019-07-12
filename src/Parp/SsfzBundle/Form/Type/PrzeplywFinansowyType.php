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
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;

/**
 * Typ formularza przeplyw finansowy
 */
class PrzeplywFinansowyType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania przeplywu finansowego
     *
     * @SuppressWarnings("unused")
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('saldoPoczatkowe', TextType::class, [
            'label'       => 'Saldo początkowe',
            'attr'        => [
                'class' => 'decimal',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Regex([
                    'message' => 'Niepoprawny format',
                    'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{0,2}$/',
                ]),
            ],
        ]);

        $builder->add('wplywy', TextType::class, [
            'label'       => 'Wpływy',
            'attr'        => [
                'readonly' => true,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('wyjsciaZInwestycji', TextType::class, array(
            'label' => 'Wyjścia z inwestycji',
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

        $builder->add('udzialWZyskach', TextType::class, array(
            'label' => 'Udział w zyskach',
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

        $builder->add('inneWplywy', TextType::class, array(
            'label' => 'Inne',
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

        $builder->add('wyplywy', TextType::class, array(
            'label' => 'Wypływy',
            'attr' => array('readonly' => true),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('wejsciaKapitalowe', TextType::class, array(
            'label' => 'Wejścia kapitałowe',
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

        $builder->add('preinkubacjaPomyslow', TextType::class, array(
            'label' => 'Preinkubacja pomysłów',
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

        $builder->add('wydatkiOperacyjne', TextType::class, array(
            'label' => 'Wydatki operacyjne',
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

        $builder->add('podatki', TextType::class, array(
            'label' => 'Podatki',
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

        $builder->add('inneWyplywy', TextType::class, array(
            'label' => 'Inne',
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

        $builder->add('saldoKoncowe', TextType::class, array(
            'label' => 'Saldo końcowe',
            'attr' => array('readonly' => true),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('liczbaPomyslowWInkubatorze', null, array(
            'label' => 'Liczba pomysłów, które wpłynęły do inkubatora w okresie',
            'attr' => [
                'class' => 'integer',
            ],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('liczbaPomyslowOcenionych', null, array(
            'label' => 'Liczba pomysłów ocenionych w okresie',
            'attr' => [
                'class' => 'integer',
            ],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('liczbaPomyslowOcenionychPozytywnie', null, array(
            'label' => '- w tym pozytywnie',
            'attr' => [
                'class' => 'integer',
            ],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('liczbaPomyslowOcenionychNegatywnie', null, array(
            'label' => '- w tym negatywnie',
            'attr' => [
                'class' => 'integer',
            ],
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('liczbaZakonczonychPreinkubacji', null, [
            'label'       => 'Liczba zakończonych preinkubacji w okresie',
            'attr'        => [
                'class' => 'integer',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('liczbaDokonanychInwestycji', null, [
            'label'       => 'Liczba dokonanych inwestycji w okresie',
            'attr'        => [
                'class' => 'integer',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ]
        ]);
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrzeplywFinansowy::class,
            'attr'       => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
