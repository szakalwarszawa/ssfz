<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\LessThan;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePozyczkoweType extends AbstractSprawozdanieSpoType
{
    /**
     * Informuje, czy dany formularz dotyczy pożyczek.
     *
     * @var boolean
     */
    protected $czyPozyczkowy = false;

    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add(
            'minimalneOprocentowanie',
            NumberType::class,
            [
                'label'  => 'Minimalne oprocentowanie',
                'required'  => false,
                'scale'  => 2,
                'mapped' => true,
                'attr'   => [
                    'placeholder' => '%',
                    'class'       => 'width-date',
                    'maxlength' => 6,
                ],
                'constraints' => array(
                    new NotBlank(
                        array('message' => 'Należy wypełnić pole')
                    ),
                    new LessThan(
                        array(
                            'value' => '100',
                            'message' => 'Wartośc w polu nie może przekroczyć 100%'
                        )
                    )
                )
            ]
        );

        $builder->add(
            'maksymalnaWielkoscPozyczki',
            MoneyType::class,
            [
                'label'  => 'Maksymalna wielkość pożyczki (zł)',
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
                    new LessThan(
                        array(
                            'value' => '1000000000',
                            'message' => 'Kwota nie może przekraczać 999 999 999,99'
                        )
                    )
                )
            ]
        );

        $builder->add(
            'kapitalOgolem',
            MoneyType::class,
            [
                'label'  => 'Kapitał Pożyczkowy Funduszu Pożyczkowego',
                'disabled'  => true,
                'required'  => false,
                'currency'  => 'PLN',
                'mapped' => true,
                'attr'   => [
                    'class'       => 'width-short',
                ],
            ]
        );

        $builder->add(
            'skladnikiOgolem',
            CollectionType::class,
            array(
                'label'        => 'Kapitał Pożyczkowy Funduszu Pożyczkowego',
                'entry_type'   => SprawozdaniePozyczkoweSkladnikOgolemType::class,
                'allow_add'    => true,
                'by_reference' => false,
                'allow_delete' => true,
                'mapped'       => true,
                'constraints' => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => 'Należy podać przynajmniej jeden składnik kapitału i jego wartość.'
                        )
                    )
                )
            )
        );

        $builder->add(
            'kapitalWydzielony',
            MoneyType::class,
            [
                'label'  => 'w tym kapitał wydzielonego Funduszu Pożyczkowego prowadzonego zgodnie z zasadami gospodarowania monitorowanymi przez PARP',
                'disabled'  => true,
                'required'  => false,
                'currency'  => 'PLN',
                'mapped' => true,
                'attr'   => [
                    'class'       => 'width-short',
                ],
            ]
        );

        $builder->add(
            'skladnikiWydzielone',
            CollectionType::class,
            array(
                'label'  => 'Kapitał wydzielonego Funduszu Pożyczkowego',
                'entry_type' => SprawozdaniePozyczkoweSkladnikWydzielonyType::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'constraints' => array(
                    new Count(
                        array(
                            'min' => 1,
                            'minMessage' => 'Należy podać przynajmniej jeden składnik wydzielonego kapitału i jego wartość.'
                        )
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
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => SprawozdaniePozyczkowe::class,
        ));
    }
}
