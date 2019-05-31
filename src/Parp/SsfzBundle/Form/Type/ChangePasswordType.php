<?php
namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'oldPassword', PasswordType::class, array(
                'label' => 'Stare hasło'
                )
            )
            ->add(
                'newPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array(
                    'label' => 'Nowe hasło',
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
                'invalid_message' => 'Podane hasła nie zgadzają się.'
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
        $resolver->setDefaults(
            array(
            'data_class' => 'Parp\SsfzBundle\Form\Model\ChangePassword',
            )
        );
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
