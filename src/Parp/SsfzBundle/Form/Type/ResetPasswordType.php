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
 * Typ formularza resetującego hasło
 */
class ResetPasswordType extends AbstractType
{
    /**
     * Buduje formularz resetującego hasło
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

        $builder->add('newPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => [
                'label'     => 'Nowe hasło',
                'attr'      => [
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
            'invalid_message' => 'Podane hasła nie zgadzają się.'
        ));
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
        return 'reset_password';
    }
}
