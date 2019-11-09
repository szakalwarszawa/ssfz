<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Typ formularza rejestracji użytkownika
 */
class UzytkownikType extends AbstractType
{
    /**
     * Buduje formularz rejestracji użytkownika
     *
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $passwordStrengthMessage = '
            Hasło musi zawierać co najmniej:
            8 znaków i maksymalnie 255,
            2 duże litery,
            2 cyfry,
            1 znak specjalny';

        $builder->add('login', TextType::class, [
            'label' => 'Login',
            'attr'  => [
                'oninvalid' => 'this.setCustomValidity(\'Pole nie może pozostać puste.\')',
                'oninput'   => 'setCustomValidity(\'\')'
            ]
        ]);

        $builder->add('haslo', RepeatedType::class, [
            'type'          => PasswordType::class,
            'first_options' => [
                'label' => 'Hasło',
                'attr'  => [
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'title'          => $passwordStrengthMessage,
                ]
            ],
            'second_options' => [
                'label' => 'Powtórz hasło',
                'attr'  => [
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'title'          => $passwordStrengthMessage,
                ]
            ],
            'invalid_message' => 'W polach Hasło i Powtórz hasło wpisano różne hasła.'
        ]);

        $builder->add('email', EmailType::class, [
            'attr' => [
                'oninvalid' => 'this.setCustomValidity(\'Adres email nie zawiera poprawnej konstrukcji, sprawdź czy ' .
                'adres nie zawiera błędów.\')',
                'oninput'   => 'setCustomValidity(\'\')'
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
        $resolver->setDefaults(array(
            'data_class' => 'Parp\SsfzBundle\Entity\Uzytkownik',
            'validation_groups' => array('rejestracja'),
        ));
    }

    /**
     * Ustawia prefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'parp_ssfzbundle_uzytkownik';
    }
}
