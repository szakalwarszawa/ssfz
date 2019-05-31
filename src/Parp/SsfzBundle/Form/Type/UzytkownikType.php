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
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login', TextType::class, array(
            'label' => 'Login',
            'attr' => array(
                'oninvalid' => 'this.setCustomValidity(\'Pole nie może pozostać puste.\')',
                'oninput' => 'setCustomValidity(\'\')'
            )
        ));

        $builder->add('haslo', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => array(
                'label' => 'Hasło',
                'attr' => array(
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'right',
                    'title' => 'Hasło musi zawierać co najmniej
                                8 znaków i maksymalnie 255,
                                2 duże litery,
                                2 cyfry,
                                1 znak specjalny'
                )
            ),
            'second_options' => array(
                'label' => 'Powtórz hasło',
                'attr' => array(
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'right',
                    'title' => 'Hasło musi zawierać co najmniej
                                8 znaków i maksymalnie 255,
                                2 duże litery,
                                2 cyfry,
                                1 znak specjalny'
                )
            ),
            'invalid_message' => 'W polach Hasło i Powtórz hasło wpisano różne hasła.'
        ));

        $builder->add('email', EmailType::class, array(
            'attr' => array(
                'oninvalid' => 'this.setCustomValidity(\'Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres nie zawiera błędów.\')',
                'oninput' => 'setCustomValidity(\'\')'
            )
        ));
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
