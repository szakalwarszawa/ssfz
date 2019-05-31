<?php
namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Typ formularza do generowania linku resetującego hasło
 */
class ResetLinkType extends AbstractType
{
    /**
     * Buduje formularz do generowania linku resetującego hasło
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'login', TextType::class, array(
                'attr' => array(
                    'oninvalid' => 'this.setCustomValidity(\'Pole nie może pozostać puste.\')',
                    'oninput' => 'setCustomValidity(\'\')'
                ))
            )
            ->add(
                'email', EmailType::class, array(
                'attr' => array(
                    'oninvalid' => 'this.setCustomValidity(\'Adres email nie zawiera poprawnej konstrukcji, sprawdź czy adres nie zawiera błędów.\')',
                    'oninput' => 'setCustomValidity(\'\')'
                ))
            );
    }

    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'Parp\SsfzBundle\Form\Model\ResetLink'));
    }

    /**
     * Ustawia prefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'reset_link';
    }
}
