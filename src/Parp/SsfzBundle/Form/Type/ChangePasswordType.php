<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Parp\SsfzBundle\Form\Model\ChangePassword;

/**
 * Typ formularza zmiany hasła
 */
class ChangePasswordType extends AbstractType
{
    /**
     * Buduje formularz zmiany hasła
     *
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class, [
            'label' => 'Stare hasło'
        ]);

        $builder->add('newPassword', RepeatedType::class, [
            'type'            => PasswordType::class,
            'invalid_message' => 'Podane hasła nie zgadzają się.',
            'first_options'   => [
                'label' => 'Nowe hasło',
                'attr'  => [
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'title'          => 'Hasło musi zawierać co najmniej
                                         8 znaków i maksymalnie 255,
                                         2 duże litery,
                                         2 cyfry,
                                         1 znak specjalny',
                ],
            ],
            'second_options' => [
                'label' => 'Powtórz hasło',
                'attr'  => [
                    'data-toggle'    => 'tooltip',
                    'data-placement' => 'right',
                    'title'          => 'Hasło musi zawierać co najmniej
                                         8 znaków i maksymalnie 255,
                                         2 duże litery,
                                         2 cyfry,
                                         1 znak specjalny',
                ],
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
        $resolver->setDefaults([
            'data_class' => ChangePassword::class,
        ]);
    }

    /**
     * Ustawia prefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'change_password';
    }
}
