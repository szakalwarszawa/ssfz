<?php

namespace Parp\SsfzBundle\Form\Type;

use Parp\SsfzBundle\Entity\Spolka;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Typ formularza spółki
 */
class SpolkaType extends AbstractType
{
    /**
     * Pobiera wartości do słownika form prawnych beneficjenta
     *
     * @param  type $narzedziaSvc serwis NarzedziaService
     *
     * @return array
     */
    private function getFormaPrawnaBeneficjentaListaWartosci($narzedziaSvc)
    {
        $entityList = $narzedziaSvc->getSlownikFormaPrawnaBeneficjenta();
        foreach ($entityList as $value) {
            $result[$value->getNazwa()]  = $value->getNazwa();
        }

        return $result;
    }

    /**
     * Pobiera wartości do słownika województw
     *
     * @param  type $narzedziaSvc serwis NarzedziaService?????????????????????????????????????
     *
     * @return array
     */
    private function getWojewodztwoListaWartosci($narzedziaSvc)
    {
        $entityList = $narzedziaSvc->getSlownikWojewodztwo();
        foreach ($entityList as $value) {
            $result[$value->getNazwa()]  = $value->getNazwa();
        }

        return $result;
    }

    /**
     * Pobiera wartości do słownika działów gospodarki
     *
     * @param  type $narzedziaSvc serwis NarzedziaService?????????????????????????????????????
     * @return array
     */
    private function getGospodarkaDzialListaWartosci($narzedziaSvc)
    {
        $entityList = $narzedziaSvc->getSlownikGospodarkaDzial();
        foreach ($entityList as $value) {
            $result[$value->getNazwa()]  = $value->getNazwa();
        }

        return $result;
    }

    /**
     * Buduje formularz do wypełniania profilu beneficjenta
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $narzedziaSvc = $options['narzedzia_svc'];

        $builder->add('nazwa', null, array(
            'label' => 'Nazwa spółki',
            'attr' => array(
                'maxlength' => '140',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Length(
                    array('max' => '140', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} ' .
                    'znaków.')
                ),
            )
        ));

        $builder->add('forma', ChoiceType::class, array(
            'label' => 'Forma prawna',
            'placeholder' => '',
            'choices' => $this->getFormaPrawnaBeneficjentaListaWartosci($narzedziaSvc),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('siedzibaMiasto', null, array(
            'label' => 'Siedziba (Miasto)',
            'attr' => array(
                'maxlength' => '140',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Length(
                    array('max' => '140', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} ' .
                        'znaków.')
                ),
            )
        ));

        $builder->add('siedzibaWojewodztwo', ChoiceType::class, array(
            'label' => 'Siedziba (Województwo)',
            'placeholder' => '',
            'choices' => $this->getWojewodztwoListaWartosci($narzedziaSvc),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('branza', ChoiceType::class, array(
            'label' => 'Branża',
            'placeholder' => '',
            'choices' => $this->getGospodarkaDzialListaWartosci($narzedziaSvc),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('opis', null, array(
            'label' => 'Krótki opis przedmiotu działalności',
            'attr' => array(
                'maxlength' => '1000',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Length(
                    array('max' => '1000', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} ' .
                        'znaków.')
                ),
            )
        ));

        $builder->add('dataPowolania', null, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => array(
                'class' => 'js-datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd'
            ),
            'label' => 'Data powołania spółki',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('krs', null, array(
            'label' => 'Nr KRS',
            'attr' => array(
                'maxlength' => '10',
                'class' => 'ssfz-digits',
            ),
        ));

        $builder->add('nip', null, array(
            'label' => 'NIP',
            'attr' => array(
                'maxlength' => '10',
                'class' => 'ssfz-digits',
            ),
            'constraints' => array(
                new Regex(
                    array('message' => 'Niepoprawny format NIP', 'pattern' => '/^[0-9]{10}$/')
                )
            )
        ));

        $builder->add('kwInwestycji', TextType::class, array(
            'label' => 'Kwota inwestycji Beneficjenta',
            'attr' => array(
                'class' => 'ssfz-pln',
                'maxlength' => '16',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('kwWsparcia', TextType::class, array(
            'label' => 'W tym ze środków wsparcia',
            'attr' => array(
                'class' => 'ssfz-pln',
                'maxlength' => '16',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('kwPryw', TextType::class, array(
            'label' => 'W tym ze środków prywatnych',
            'attr' => array(
                'class' => 'ssfz-pln',
                'maxlength' => '16',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('zakonczona', ChoiceType::class, array(
            'choices' => array(
                null => '',
                0 => 'Nie',
                1 => 'Tak',
            ),
            'label' => 'Czy Inwestycja została zakończona?',
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                )
            )
        ));

        $builder->add('dataWyjscia', null, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'attr' => array(
                'class' => 'js-datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'yyyy-mm-dd'
            ),
            'label' => 'Data wyjścia z inwestycji',
        ));

        $builder->add('kwDezinwestycji', TextType::class, array(
            'label' => 'Kwota uzyskana z dezinwestycji',
            'attr' => array(
                'class' => 'ssfz-pln',
                'maxlength' => '16',
            ),
            'constraints' => array(
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('zwrotInwestycji', TextType::class, array(
            'label' => 'Zwrot inwestycji (%)',
            'read_only' => true,
             'constraints' => array(
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('npv', TextType::class, array(
            'label' => 'NPV',
            'attr' => array(
                'class' => 'ssfz-pln',
                'maxlength' => '16',
            ),
            'constraints' => array(
                new Regex(
                    array('message' => 'Niepoprawny format', 'pattern' => '/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/')
                )
            )
        ));

        $builder->add('udzialowcy', null, array(
            'label' => 'Udziałowcy(Nazwa i % udziału)',
            'attr' => array(
                'maxlength' => '1000',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Length(
                    array('max' => '1000', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} ' .
                    'znaków.')
                ),
            )
        ));

        $builder->add('prezes', null, array(
            'label' => 'Prezes Zarządu',
            'attr' => array(
                'maxlength' => '140',
            ),
            'constraints' => array(
                new NotBlank(
                    array('message' => 'Należy wypełnić pole')
                ),
                new Length(
                    array('max' => '140', 'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} ' .
                        'znaków.')
                ),
            )
        ));

        $builder->add('zarzadPozostali', null, [
            'label' => 'Pozostali Członkowie Zarządu',
            'attr'  => [
                'maxlength' => '1000',
            ],
            'constraints' => [
                new Length([
                    'max'        => '1000',
                    'maxMessage' => 'W polu nie może znajdować się więcej niż {{ limit }} znaków.',
                ]),
            ],
        ]);

        $builder->add('przekierowanie', HiddenType::class, [
            'mapped' => false,
        ]);
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('narzedzia_svc');
        $resolver->setDefaults([
            'data_class'         => Spolka::class,
            'attr'               => [
                'novalidate' => 'novalidate',
            ],
            'allow_extra_fields' => true,
        ]);
    }
}
