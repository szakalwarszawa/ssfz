<?php

namespace Parp\SsfzBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczenioweSkladnikWydzielony;

/**
 * Typ formularza sprawozdania
 */
class SprawozdaniePoreczenioweSkladnikWydzielonyType extends SprawozdaniePoreczenioweSkladnikOgolemType
{
    /**
     * Ustawia opcje konfiguracji
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => SprawozdaniePoreczenioweSkladnikWydzielony::class,
        ]);
    }
}
