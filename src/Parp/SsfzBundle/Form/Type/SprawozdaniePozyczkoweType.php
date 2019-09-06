<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\Slownik\TakNie;

/**
 * Formularz dla sprawozdania pożyczkowego.
 */
class SprawozdaniePozyczkoweType extends AbstractSprawozdanieSpoType
{
    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('minimalneOprocentowanie', NumberType::class, [
            'label'     => 'Minimalne oprocentowanie',
            'required'  => false,
            'scale'     => 2,
            'mapped'    => true,
            'attr'      => [
                'placeholder' => '%',
                'class'       => 'width-date',
                'maxlength'   => 6,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new LessThan([
                    'value' => '100',
                    'message' => 'Wartośc w polu nie może przekroczyć 100%'
                ]),
            ],
        ]);

        $builder->add('maksymalnaWielkoscPozyczki', MoneyType::class, [
            'label'       => 'Maksymalna wielkość pożyczki (zł)',
            'required'    => false,
            'currency'    => 'PLN',
            'mapped'      => true,
            'attr'        => [
                'placeholder' => 'kwota w PLN',
                'class'       => 'width-short',
                'maxlength'   => 12,
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
                new LessThan([
                    'value'   => '1000000000',
                    'message' => 'Kwota nie może przekraczać 999 999 999,99'
                ]),
            ],
        ]);

        $builder->add('kapitalOgolem', MoneyType::class, [
            'label'     => 'Kapitał Pożyczkowy Funduszu Pożyczkowego',
            'disabled'  => true,
            'required'  => false,
            'currency'  => 'PLN',
            'mapped'    => true,
            'attr'      => [
                'class' => 'width-short',
            ],
        ]);

        $builder->add('skladnikiOgolem', CollectionType::class, [
            'label'        => 'Kapitał Pożyczkowy Funduszu Pożyczkowego',
            'entry_type'   => SprawozdaniePozyczkoweSkladnikOgolemType::class,
            'allow_add'    => true,
            'by_reference' => false,
            'allow_delete' => true,
            'mapped'       => true,
            'constraints'  => [
                new Count([
                    'min'        => 1,
                    'minMessage' => 'Należy podać przynajmniej jeden składnik kapitału i jego wartość.',
                ]),
            ],
        ]);

        $builder->add('kapitalWydzielony', MoneyType::class, [
            'label'    => 'w tym kapitał wydzielonego Funduszu Pożyczkowego prowadzonego zgodnie z zasadami gospodarowania monitorowanymi przez PARP',
            'disabled' => true,
            'required' => false,
            'currency' => 'PLN',
            'mapped'   => true,
            'attr'     => [
                'class' => 'width-short',
            ],
        ]);

        $builder->add('skladnikiWydzielone', CollectionType::class, [
            'label'        => 'Kapitał wydzielonego Funduszu Pożyczkowego',
            'entry_type'   => SprawozdaniePozyczkoweSkladnikWydzielonyType::class,
            'allow_add'    => true,
            'by_reference' => false,
            'allow_delete' => true,
            'constraints'  => [
                new Count([
                    'min'        => 1,
                    'minMessage' => 'Należy podać przynajmniej jeden składnik wydzielonego kapitału i jego wartość.',
                ]),
            ],
        ]);

        $builder->add('dataZatwierdzeniaZasadGospodarowania', DateType::class, [
            'label'       => 'Data zatwierdzenia zasad gospodarowania funduszem pożyczkowym przez PARP',
            'required'    => false,
            'html5'       => false,
            'widget'      => 'single_text',
            'format'      => 'yyyy-MM-dd',
                'mapped' => true,
            'attr'        => [
                'class'            => 'js-datepicker width-date',
                'data-provide'     => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('czyUdzielaPoAnalizieRyzyka', EntityType::class, [
            'label'       => 'Fundusz udziela pożyczek po analizie ryzyka niespłacenia i po ustanowieniu zabezpieczenia',
            'class'       => TakNie::class,
            'required'    => false,
            'expanded'    => true,
            'placeholder' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);

        $builder->add('czyNieWTrudnejSytuacji', EntityType::class, [
            'label'       => 'Pożyczki udzielane są przedsiębiorcom nie będącym w trudniej sytuacji',
            'class'       => TakNie::class,
            'required'    => false,
            'expanded'    => true,
            'placeholder' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ],
        ]);
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class'       => SprawozdaniePozyczkowe::class,
            'program'          => null,
            'typ_sprawozdania' => 'sprawozdanie_pozyczkowe',
        ]);
    }
}
