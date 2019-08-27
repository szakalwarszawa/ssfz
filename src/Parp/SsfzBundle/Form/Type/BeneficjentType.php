<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Parp\SsfzBundle\Constraints\PhoneNumberRequired;
use Parp\SsfzBundle\Entity\Beneficjent;

/**
 * Typ formularza profilu beneficjenta
 */
class BeneficjentType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania profilu beneficjenta
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nazwa', null, [
            'label'       => 'Nazwa',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('umowy', CollectionType::class, [
            'entry_type'    => UmowaType::class,
            'entry_options' => [
                'label'   => false,
                'program' => $options['program'],
            ],
            'allow_add'     => true,
            'by_reference'  => false,
            'allow_delete'  => true,
        ]);

        $builder->add('adrWojewodztwo', ChoiceType::class, [
            'label'      => 'Województwo',
            'choices'    => [
                ''                    => '',
                'dolnośląskie'        => 'dolnośląskie',
                'kujawsko-pomorskie'  => 'kujawsko-pomorskie',
                'lubelskie'           => 'lubelskie',
                'lubuskie'            => 'lubuskie',
                'łódzkie'             => 'łódzkie',
                'małopolskie'         => 'małopolskie',
                'mazowieckie'         => 'mazowieckie',
                'opolskie'            => 'opolskie',
                'podkarpackie'        => 'podkarpackie',
                'podlaskie'           => 'podlaskie',
                'pomorskie'           => 'pomorskie',
                'śląskie'             => 'śląskie',
                'świętokrzyskie'      => 'świętokrzyskie',
                'warmińsko-mazurskie' => 'warmińsko-mazurskie',
                'wielkopolskie'       => 'wielkopolskie',
                'zachodniopomorskie'  => 'zachodniopomorskie',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('adrMiejscowosc', TextType::class, [
            'label'       => 'Miejscowość',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('adrUlica', TextType::class, [
            'label'       => 'Ulica',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('adrBudynek', TextType::class, [
            'label'       => 'Nr budynku',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('adrLokal', TextType::class, [
            'label' => 'Nr lokalu'
        ]);

        $builder->add('adrKod', TextType::class, [
            'label'       => 'Kod pocztowy',
            'required'    => false,
            'attr'        => [
                'placeholder' => '',
                'maxlength'   => 6,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Regex([
                    'message' => 'Niepoprawny format kodu pocztowego',
                    'pattern' => '/^[0-9]{2}\-[0-9]{3}$/',
                ]),
            ],
        ]);

        $builder->add('adrPoczta', TextType::class, [
            'label'       => 'Poczta',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ]
        ]);

        $builder->add('telStacjonarny', TextType::class, [
            'label'       => 'Telefon stacjonarny',
            'constraints' => [
                new PhoneNumberRequired(),
            ],
        ]);

        $builder->add('telKomorkowy', TextType::class, [
            'label'       => 'Telefon komórkowy',
            'constraints' => [
                new PhoneNumberRequired(),
            ],
        ]);

        $builder->add('email', TextType::class, [
            'label'       => 'Adres e-mail',
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new Email([
                    'message' => 'Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres nie zawiera błędów.',
                ]),
            ],
        ]);

        $builder->add('fax', TextType::class, [
            'label' => 'Fax'
        ]);

        $builder->add('osobyZatrudnione', CollectionType::class, [
            'entry_type'    => OsobaZatrudnionaType::class,
            'entry_options' => [
                'label' => false,
            ],
            'allow_add'     => true,
            'by_reference'  => false,
            'allow_delete'  => true,
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
            'data_class' => Beneficjent::class,
            'attr'       => [
                'novalidate' => 'novalidate',
            ],
            'program'    => null,
        ]);
    }
}
