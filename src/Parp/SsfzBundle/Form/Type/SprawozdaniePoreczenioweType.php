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
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Entity\Slownik\TakNie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePoreczenioweType extends AbstractSprawozdanieSpoType
{
    /**
     * Informuje, czy dany formularz dotyczy pożyczek.
     *
     * @var bool
     */
    protected $czyPozyczkowy = false;

    /**
     * Buduje formularz do wypełniania sprawozdania
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    
        $builder->add('czyPosiadaWydzielonyFundusz', EntityType::class, [
            'label'       => 'Posiada wydzielony księgowo fundusz',
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

        $builder->add('czyOprocentowanieNieNizszeOdStopy', EntityType::class, [
            'label'       => 'Fundusz udziela poręczeń kredytów i pożyczek nie niżej oprocentowanych niż stopa referencyjna',
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

        $builder->add('czyZaWynagrodzeniem', EntityType::class, [
            'label'       => 'Poręczenia udzielane są za wynagrodzeniem',
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

        $builder->add('czyNiePrzekraczaja80', EntityType::class, [
            'label'       => 'Poręczenia są udzielane w wysokości nie przekraczającej 80% zobowiązania którego dotyczą',
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

        $builder->add('kapitalOgolem', MoneyType::class, [
            'label'    => 'Kapitał Funduszu Poręczeniowego',
            'disabled' => true,
            'required' => false,
            'currency' => 'PLN',
            'mapped'   => true,
            'attr'     => [
                'class' => 'width-short',
            ],
        ]);

        $builder->add('skladnikiOgolem', CollectionType::class, [
            'label'        => 'Kapitał Funduszu Poręczeniowego',
            'entry_type'   => SprawozdaniePoreczenioweSkladnikOgolemType::class,
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
            'label'    => 'w tym kapitał wydzielonego Funduszu Poręczeniowego prowadzonego zgodnie z zasadami gospodarowania monitorowanymi przez PARP',
            'disabled' => true,
            'required' => false,
            'currency' => 'PLN',
            'mapped'   => true,
            'attr'     => [
                'class' => 'width-short',
            ],
        ]);

        $builder->add('skladnikiWydzielone', CollectionType::class, [
            'label'        => 'w tym kapitał wydzielonego Funduszu Poręczeniowego prowadzonego zgodnie z zasadami gospodarowania monitorowanymi przez PARP',
            'entry_type'   => SprawozdaniePoreczenioweSkladnikWydzielonyType::class,
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
            'data_class' => SprawozdaniePoreczeniowe::class,
        ));
    }
}
