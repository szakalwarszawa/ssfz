<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;

/**
 * Typ formularza oceny sprawozdania
 */
class SprawozdanieOcenType extends AbstractType
{
    /**
     * Buduje formularz do dodania komentarza przy cofnięciu sprawozdania
     * do beneficjenta
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('uwagi', HiddenType::class, []);
        $builder->add('status', HiddenType::class, [];
    }
    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AbstractSprawozdanie::class,
            'attr'       => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
