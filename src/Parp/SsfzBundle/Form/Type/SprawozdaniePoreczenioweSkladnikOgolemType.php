<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczenioweSkladnikOgolem;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePoreczenioweSkladnikOgolemType extends SprawozdaniePozyczkoweSkladnikOgolemType
{
    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => SprawozdaniePoreczenioweSkladnikOgolem::class,
        ));
    }
}
