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

/**
 * Typ formularza profilu beneficjenta
 */
class BeneficjentType extends AbstractType
{
    /**
     * Buduje formularz do wypełniania profilu beneficjenta
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'nazwa', null, array(
            'label' => 'Nazwa',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );

        $builder->add(
            'umowy', CollectionType::class, array(
            'entry_type' => UmowaType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
            )
        );
        $builder->add(
            'adrWojewodztwo', ChoiceType::class, array(
            'label' => 'Województwo',
            'choices' => array(
                '' => '',
                'dolnośląskie' => 'dolnośląskie',
                'kujawsko-pomorskie' => 'kujawsko-pomorskie',
                'lubelskie' => 'lubelskie',
                'lubuskie' => 'lubuskie',
                'łódzkie' => 'łódzkie',
                'małopolskie' => 'małopolskie',
                'mazowieckie' => 'mazowieckie',
                'opolskie' => 'opolskie',
                'podkarpackie' => 'podkarpackie',
                'podlaskie' => 'podlaskie',
                'pomorskie' => 'pomorskie',
                'śląskie' => 'śląskie',
                'świętokrzyskie' => 'świętokrzyskie',
                'warmińsko-mazurskie' => 'warmińsko-mazurskie',
                'wielkopolskie' => 'wielkopolskie',
                'zachodniopomorskie' => 'zachodniopomorskie',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'adrMiejscowosc', null, array(
            'label' => 'Miejscowość',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'adrUlica', null, array(
            'label' => 'Ulica',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'adrBudynek', null, array(
            'label' => 'Nr budynku',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'adrLokal', null, array(
            'label' => 'Nr lokalu'
            )
        );
        $builder->add(
            'adrKod', null, array(
            'label' => 'Kod pocztowy',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'adrPoczta', null, array(
            'label' => 'Poczta',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'telStacjonarny', null, array(
            'label' => 'Telefon stacjonarny',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'telKomorkowy', null, array(
            'label' => 'Telefon komórkowy',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
            )
        );
        $builder->add(
            'email', null, array(
            'label' => 'Adres e-mail',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Email(
                    array('message' => 'Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres nie zawiera błędów.')
                )
            )
            )
        );
        $builder->add(
            'fax', null, array(
            'label' => 'Fax'
            )
        );
        $builder->add(
            'osobyZatrudnione', CollectionType::class, array(
            'entry_type' => OsobaZatrudnionaType::class,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
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
            'data_class' => Beneficjent::class,
            'attr' => array('novalidate' => 'novalidate'),
            )
        );
    }
}
