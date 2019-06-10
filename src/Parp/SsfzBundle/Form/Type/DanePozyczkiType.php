<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Parp\SsfzBundle\Entity\DanePozyczki;

/**
 * Formularz do wprowadzania danych o pożyczce.
 */
class DanePozyczkiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $integerFieldConstraints = [
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
    
        $builder->add('id', HiddenType::class, [
            'label'       => 'ID',
            'attr'        => [
                'class' => 'decimal',
            ],
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Należy wypełnić pole',
                ]),
            ]
        ]);

        // protected $sprawozdanie;

        $integerFields = [
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
            'liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw',
            'liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej',
            'liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej',
            'liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej',
            'liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej',
            'liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej',
            'liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej',
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
        ];

        foreach ($integerFields as $field) {
            $builder->add($field, IntegerType::class, [
                'label'       => false,
                'attr'        => [
                    'class' => 'integer',
                ],
                'constraints' => $integerFieldConstraints,
            ]);
        }
    }

    /**
     * Ustawia opcje przekazana do formularza.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DanePozyczki::class,
        ));
    }
}
