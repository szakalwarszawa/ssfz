<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Parp\SsfzBundle\Entity\DanePoreczen;

/**
 * Formularz do wprowadzania danych o poręczeniach.
 */
class DanePoreczenType extends AbstractType
{
    const DECIMAL_FIELDS = [
    ];

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action_url']);
        $this->addIntegerFields($builder, $options);
        $this->addDecimalFields($builder, $options);
    }

    /**
     * Dodaje zestaw pól na wartości liczbowe całkowite dodatni z zakresu 0-99999.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    private function addIntegerFields(FormBuilderInterface $builder, array $options)
    {
        $constraints = [
            new Assert\NotBlank([
                'message' => 'Należy wypełnić pole',
            ]),
            new Assert\Type([
                'type'    => 'integer',
                'message' => 'Pole może zawierać tylko liczby całkowite',
            ]),
            new Assert\Range([
                'min'            => 0,
                'max'            => 99999,
                'invalidMessage' => 'Pole może zawierać wartości od 0 do 99999',
            ]),
        ];

        $fields = [
            'liczbaWspolpracujacychBankow',
            'liczbaWspolpracujacychFunduszyPozyczkowych',
            'liczbaInnychPodmiotowWspolpracujacych',
        ];

        foreach ($fields as $field) {
            $builder->add($field, IntegerType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'uint-5',
                ],
                'constraints' => $constraints,
            ]);
        }
    }

    /**
     * Dodaje zestaw pól na wartości liczbowe dziesiętne dodatnie z zakresu 0-999999999.99.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
      *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    private function addDecimalFields(FormBuilderInterface $builder, array $options)
    {
        $constraints = [
            new Assert\NotBlank([
                'message' => 'Należy wypełnić pole',
            ]),
            new Assert\Regex([
                'pattern' => '/^((([1-9])([\d\ ])*)|0)\.([\d]){2,2}$/',
                'message' => 'Pole może zawierać tylko liczby dziesiętne z zakresu 0.00 - 999 999 999.99',
            ]),
        ];

        foreach (self::DECIMAL_FIELDS as $field) {
            $builder->add($field, TextType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'decimal-11-2',
                ],
                'constraints' => $constraints,
                'by_reference' => false,
            ]);
        }
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'form_dane_poreczen';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DanePoreczen::class,
        ]);

        $resolver->setRequired([
            'action_url',
        ]);

        $resolver->setAllowedTypes('action_url', 'string');
    }
}
