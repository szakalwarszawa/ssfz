<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Parp\SsfzBundle\Entity\DanePozyczek;

/**
 * Formularz do wprowadzania danych o pożyczkach.
 */
class DanePozyczekType extends AbstractType
{
    const DECIMAL_FIELDS = [
        // Kwoty pożyczek udzielonych w danym okresie sprawozdawczym.
        'kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw',
        'kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw',
        'kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw',
        'kwotaPozyczekObrotowychDo10000Pln',
        'kwotaPozyczekObrotowychOd10001Do30000Pln',
        'kwotaPozyczekObrotowychOd30001Do50000Pln',
        'kwotaPozyczekObrotowychOd50001Do120000Pln',
        'kwotaPozyczekObrotowychOd120001Do300000Pln',
        'kwotaPozyczekObrotowychOd300001Pln',
        'kwotaPozyczekInwestycyjnychDo10000Pln',
        'kwotaPozyczekInwestycyjnychOd10001Do30000Pln',
        'kwotaPozyczekInwestycyjnychOd30001Do50000Pln',
        'kwotaPozyczekInwestycyjnychOd50001Do120000Pln',
        'kwotaPozyczekInwestycyjnychOd120001Do300000Pln',
        'kwotaPozyczekInwestycyjnychOd300001Pln',
        'kwotaPozyczekInwestycyjnoObrotowychDo10000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln',
        'kwotaPozyczekInwestycyjnoObrotowychOd300001Pln',
        'kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne',
        'kwotaPozyczekDo10000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe',
        'kwotaPozyczekOd300001PlnNaDzialaniaHandlowe',
        'kwotaPozyczekDo10000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe',
        'kwotaPozyczekOd300001PlnNaDzialaniaUslugowe',
        'kwotaPozyczekDo10000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze',
        'kwotaPozyczekOd300001PlnNaDzialaniaBudownicze',
        'kwotaPozyczekDo10000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze',
        'kwotaPozyczekOd300001PlnNaDzialaniaRolnicze',
        'kwotaPozyczekDo10000PlnNaDzialaniaInne',
        'kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne',
        'kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne',
        'kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne',
        'kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne',
        'kwotaPozyczekOd300001PlnNaDzialaniaInne',
        // Kwoty pożyczek aktywnych i straconych w danym okresie sprawozdawczym.
        'kwotaPozyczekAktywnychOgolem',
        'kwotaPozyczekAktywnychSplacanychTerminowo',
        'kwotaPozyczekAktywnychWymagajacychMonitorowania',
        'kwotaPozyczekStraconych',
    ];

    const DECIMAL_PERCENT_FIELDS = [
        // Współczynniki.
        'wspolczynnikStratWDanymOkresieWgLiczbyPozyczek',
        'wspolczynnikStratWCalymOkresieWgLiczbyPozyczek',
        'wspolczynnikStratWDanymOkresieWgKwotyPozyczek',
        'wspolczynnikStratWCalymOkresieWgKwotyPozyczek',
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
            // Liczba pożyczek udzielonych w danym okresie sprawozdawczym.
            'liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw',
            'liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw',
            'liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw',
            'liczbaPozyczekObrotowychDo10000Pln',
            'liczbaPozyczekObrotowychOd10001Do30000Pln',
            'liczbaPozyczekObrotowychOd30001Do50000Pln',
            'liczbaPozyczekObrotowychOd50001Do120000Pln',
            'liczbaPozyczekObrotowychOd120001Do300000Pln',
            'liczbaPozyczekObrotowychOd300001Pln',
            'liczbaPozyczekInwestycyjnychDo10000Pln',
            'liczbaPozyczekInwestycyjnychOd10001Do30000Pln',
            'liczbaPozyczekInwestycyjnychOd30001Do50000Pln',
            'liczbaPozyczekInwestycyjnychOd50001Do120000Pln',
            'liczbaPozyczekInwestycyjnychOd120001Do300000Pln',
            'liczbaPozyczekInwestycyjnychOd300001Pln',
            'liczbaPozyczekInwestycyjnoObrotowychDo10000Pln',
            'liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln',
            'liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln',
            'liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln',
            'liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln',
            'liczbaPozyczekInwestycyjnoObrotowychOd300001Pln',
            'liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne',
            'liczbaPozyczekDo10000PlnNaDzialaniaHandlowe',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe',
            'liczbaPozyczekOd300001PlnNaDzialaniaHandlowe',
            'liczbaPozyczekDo10000PlnNaDzialaniaUslugowe',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe',
            'liczbaPozyczekOd300001PlnNaDzialaniaUslugowe',
            'liczbaPozyczekDo10000PlnNaDzialaniaBudownicze',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze',
            'liczbaPozyczekOd300001PlnNaDzialaniaBudownicze',
            'liczbaPozyczekDo10000PlnNaDzialaniaRolnicze',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze',
            'liczbaPozyczekOd300001PlnNaDzialaniaRolnicze',
            'liczbaPozyczekDo10000PlnNaDzialaniaInne',
            'liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne',
            'liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne',
            'liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne',
            'liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne',
            'liczbaPozyczekOd300001PlnNaDzialaniaInne',
            // Liczba pożyczek aktywnych i straconych w danym okresie sprawozdawczym.
            'liczbaPozyczekAktywnychOgolem',
            'liczbaPozyczekAktywnychSplacanychTerminowo',
            'liczbaPozyczekAktywnychWymagajacychMonitorowania',
            'liczbaPozyczekStraconych',
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
            // Ta walidacja nie zadziała jeśli kwoty są sformatowane np. 100 200 300.01.
            // Jej rolę przejąło sprawadzenie zgodności z wyrażeniem regularnym.
            // new Assert\Range([
            //     'min'            => 0,
            //     'max'            => 999999999.99,
            //     'invalidMessage' => 'Pole może zawierać wartości od 0.00 do 999999999.99',
            // ]),
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

        foreach (self::DECIMAL_PERCENT_FIELDS as $field) {
            $builder->add($field, TextType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'percent-11-2',
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
        return 'form_dane_pozyczek';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DanePozyczek::class,
        ]);

        $resolver->setRequired([
            'action_url',
        ]);

        $resolver->setAllowedTypes('action_url', 'string');
    }
}
